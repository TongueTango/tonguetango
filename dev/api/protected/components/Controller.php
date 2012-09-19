<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
    /**
      * @var  string  requested action
      */
     protected $_action_requested = '';

     /**
      * JSON decoded version of post body
      * @var stdClass
      */
     protected $_request_data;

     /**
      * Raw array details of uploaded file.
      * @var array
      */
     protected $_request_file;


     /**
      * General reference variable for date
      * formatting definition
      * @var string
      */
     protected $_date_format = 'Y-m-d H:i:s';

     
    
    
    /**
	 * Container for currently identified device.
	 * @var Model_Device
	 */
	public static $device	= null;

	/**
	 * Container for currently identified user.
	 * @var Model_User
	 */
	public static $user		= null;
    
     /**
      * General container for response data.
      * @var stdClass
      */
    protected $_response_data;
	
    
    protected $headers = array();
    
   /**
    * Container for authenticated user.
    * @var Model_User
    */
    protected $_user = null;
     
    /**
    * Container for authenticated device.
    * @var Model_Device
    */
    protected $_device = null;
    
    /*
     * define requset content type
     */
    protected static $content_type = null;
    
    
    protected function beforeAction($action)
    {
         $this->setHeaders();
         Yii::log("~~~~~~~~~~~~~~~~\Api Controller Initializing", 'info', 'system.web.CController'); 
     	 
         if(isset($this->headers['token'])) {
             $auth_token = $this->headers['token'];
         }
         
         Yii::log("auth_token: $auth_token", 'info', 'system.web.CController'); 
         if( !isset($auth_token)) {
         	$auth_token = $this->request->post('token');
         }
                  
         // Deny requests to anywhere but user without a valid
         // auth token.
         $exceptions = array('user', 'error', 'login', 'cron');
         $this->auth_user($auth_token, $exceptions);
         
         $this->_action_requested = $action->id;
         $this->_response_data = new stdClass();

         //$method = Yii::app()->request->getRequestType();
         
         Yii::log("Request: ".$action->controller->id."/".$action->id, 'info', 'system.web.CController'); 
         
         // Handle non-existant methods gracefully
         if (!method_exists($this, 'action'.ucfirst($action->id)))
         {
            $this->action_invalid($action->id);
         	
         }
         // Process input data
         
         $this->_process_input();
         
         Yii::log("INPUT: ".print_r( $this->_request_data, true), 'info', 'system.web.CController'); 
         
         return true;
    }
    
    /**
      * Process any relevant input values.
      * Uses Content-Type header value to determine the
      * necessary format to process.
      * @return Controller_Rest
      */
     protected function _process_input()
     {
     	$skip_post	= false;
     	
        $content_type	= self::$content_type;
        if( strpos($content_type, ';') ) {
            $content_type	= substr($content_type, 0, strpos($content_type, ';'));
        }
        
        switch($content_type) {
            case 'application/json':
                $post_body = file_get_contents('php://input');
                $this->_process_json($post_body);
                break;
            case 'multipart/form-data':
                $skip_post = true;
                $this->_process_multipart($this->request->post('body'));
                break;
            default:
                $post_body = file_get_contents('php://input');
                $this->_process_formdata($post_body);
        }
            
     	if( !isset( $this->_request_data ) ) {
     		$this->_request_data = array();
     	}
        
//     	if( !$skip_post ) {
//            $post_body = file_get_contents('php://input');
//     		$this->_set_inputs($post_body);
//     	}
		
     	return $this;
     }

     /**
      * Process provided string as JSON data string.
      * @param string $data
      * @return Controller_Rest
      */
     protected function _process_json($data)
     {
        $data = str_replace(array("\t","\r","\n"),"",$data);
       	$input = json_decode($data, true);
       	if( is_array($input) ) {
       		$this->_set_inputs($input);
       	}
        return $this;
     }

     /**
      * Process provided string as JSON data string
      * and capture file uploads.
      * @param string $data
      * @return Controller_Rest
      */
     protected function _process_multipart($data)
     {
        Yii::log('_process_multipart', 'info', 'system.web.CController');
     	
     	$this->_process_json($data);
        Yii::log('Files: '.print_r($_FILES, true), 'info', 'system.web.CController');
     	
     	$this->_set_inputs($_FILES);
        return $this;
     }

     /**
      * Process provided string as form data.
      * @param string $data
      * @return Controller_Rest
      */
     protected function _process_formdata($data)
     {;
        $data = trim($data, ' "');
        $output = array();
        parse_str($data, $output);
       	if( is_array($output) ) {
       		$this->_set_inputs($input);
       	}
        return $this;
     }

     /**
      * Bulk definition of input values from
      * array of key value pairs.
      * @param array $data
      * @return Controller_Rest
      */
     protected function _set_inputs($data)
     {
     	// Kohana::$log->add(Log::DEBUG, '_set_inputs');
     	if( !is_array($data) ) {
     		throw new Exception('Data property expected array!', 400);
     	}
        
     	foreach( $data as $key=>$value) {
     		$this->_set_input($key, $value);
     	}
        return $this;
     }

     /**
      * Individual definition of input values.
      * @param string $key
      * @param mixed $value
      * @return Controller_Rest
      */
     protected function _set_input($key, $value)
     {
//      	Kohana::$log->add(Log::DEBUG, '_set_input');
        if( !isset( $this->_request_data) ) {
        	$this->_request_data = array();
        }
        if( is_array( $this->_request_data ) ) {
            $this->_request_data[$key] = $value;
        } elseif( is_object( $this->_request_data ) ) {
            $this->_request_data->$key = $value;
        }
        return $this;
     }

     /**
      * Attempts to authenticate a user for a provided
      * authentication token.  Optional list of
      * controllers to be excluded from being required.
      * @param string $auth_token
      * @param array $controller_exceptions
      * @return Controller_Rest
      */
     public function auth_user($auth_token, $controller_exceptions = array())
     {
		if( !$auth_token ) {
			if( !in_array(Yii::app()->controller->action->id, $controller_exceptions) ) {
                
				$this->error(array('code'=>'401','message'=>'Invalid Auth Token!'), 401);
			}
		} else {
			$this->_device = Devices::model()->find('auth_token=\'' . $auth_token . '\'');
			self::$device	= $this->_device;
			if( !$this->_device ) {
				$this->error(array('code'=>'401','message'=>'Invalid Auth Token!'), 401);
			}
			$this->_user = $this->_device->user;
			self::$user		= $this->_user;
		}
		return $this;
     }

     /**
      * Helper to cleanup output prior to return.
      */
     protected function afterAction($action)
     {
         //$this->_response_data =  self::decode_multibyte(preg_replace('/\\\\+/', '\\', json_encode( $this->_response_data ))) ;
		 Yii::log("OUTPUT: ".print_r( $this->_response_data, true), 'info', 'system.web.CController');
         $this->_sendResponse();
     }

     /**
      * Retrieve a request variable, optionally providing
      * a default value if parameter was not passed.
      * @param string $key
      * @param mixed $default
      * @return mixed
      */
     protected function getInput( $key, $default=null )
     {
     	if( is_array( $this->_request_data ) ) {
     		if( array_key_exists( $key, $this->_request_data ) ) {
     			return $this->_request_data[ $key ];
     		} else {
     			return $default;
     		}
     	} elseif( is_object( $this->_request_data ) ) {
	     	if( property_exists( $this->_request_data, $key ) ) {
	     		return $this->_request_data->$key;
	     	} elseif( isset( $default ) ) {
	     		return $default;
	     	}
     	} else {
     		return $default;
     	}
     }

     /**
      * Retrieve all input parameters.
      * @return array
      */
     protected function getInputs()
     {
     	$output = array();
     	if( is_array( $this->_request_data ) ) {
     		$output = $this->_request_data;
     	} elseif( is_object( $this->_request_data ) ) {
     		foreach( get_object_vars( $this->_request_data ) as $key=>$value ) {
     			$output[ $key ] = $value;
     		}
     	} else {
     		throw new Exception('Unable to parse input container!', 500);
     	}
     	return $output;
     }

     /**
      * Define a response data variable with value.
      * @param string $key
      * @param mixed $value
      * @return Controller_Rest
      */
     protected function setOutput( $key, $value )
     {
     	$this->_response_data->$key = $value;
     	return $this;
     }

     /**
      * Helper method to throw error message responses.
      * @param mixed $message
      * @param int $code
      */
     protected function error($error, $code = 400, $content_type = 'application/json')
     {
        if(!is_null(self::$content_type))
            $content_type = self::$content_type;
     	$this->_sendResponse($code , $error , $content_type);
     }

     /**
      * Sends a 405 "Method Not Allowed" response and a list of allowed actions.
      */
     public function action_invalid($action)
     {
         $this->_sendResponse(405, "Action " . $action . "is invalid", self::$content_type);
         
     }
     
   protected function _sendResponse($status = 200, $body = null,  $content_type = 'text/html')
   {
        $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
        header($status_header);
        if(self::$content_type) {
            $content_type = self::$content_type;
        }
        header('Content-type: ' . $content_type);

        if(is_null($body)) {
            $body = $this->_response_data;
        }
        Yii::log("User:" ."User: " . print_r($this->_response_data, true), 'info', 'system.web.CController'); 
        echo CJSON::encode($body);
        Yii::app()->end();
   }
    
   protected function _getStatusCodeMessage($status)
   {
	   $codes = Array(
		   200 => 'OK',
		   400 => 'Bad Request',
		   401 => 'Unauthorized',
		   402 => 'Payment Required',
		   403 => 'Forbidden',
		   404 => 'Not Found',
		   500 => 'Internal Server Error',
		   501 => 'Not Implemented',
	   );
	   return (isset($codes[$status])) ? $codes[$status] : '';
   }
   
   protected function setHeaders()
   {
       $headers = array();
       foreach ($_SERVER as $key => $value) {
           if (strpos($key, 'HTTP_') === 0) {
               $headers[strtolower(str_replace(' ', '', ucwords(str_replace('_', ' ', strtolower(substr($key, 5))))))] = $value;
           }
       }
       
       if (isset($_SERVER['CONTENT_TYPE']) &&  ! empty($_SERVER['CONTENT_TYPE']))
	   {
            self::$content_type = $_SERVER['CONTENT_TYPE'];
       }
       else 
       {
           self::$content_type = 'application/json';
       }
       $this->headers = $headers;
   }
   
   /**
	 * Utility to decode multi-byte HTML entities.
	 * @param string|array $string
	 * @return string|array
	 */
	public static function decode_multibyte($string)
	{
		return preg_replace_callback('/(&#?[a-zA-Z0-9]+;)/', array('Controller', '_decode_multibyte_chars'), $string);
	}

	/**
	 * Private utility to decode a single HTML
	 * encoded multi-byte entity.
	 * @param string $chars
	 * @return string
	 */
	private static function _decode_multibyte_chars($chars)
	{
		return mb_convert_encoding($chars[1], "UTF-8", "HTML-ENTITIES");
	}
}