<?php defined('SYSPATH') or die('No direct script access!');
// @todo Research JSON input handling for same name properties (auto-array generation)
class Kohana_Notification_Packet
{
	protected $_body;
	protected $_code;
	protected $_format;
	protected $_headers = array();
	protected $_method;
	protected $_request_uri;
	protected $_root_node = 'entry';
	protected $_force_array = array('aliases','device_tokens','tags','exclude_tokens','entry');
	public function __construct($data=null)
	{
		// Handle Zend responses (Service Responses)
		if( $data instanceof Zend_Http_Response ) {
			$this
				->setCode( $data->getStatus() )
				->setBody( $data->getBody() )
				->setHeaders( $data->getHeaders() )
				->setFormat( $this->getHeader('content-type') );
		// Handle Kohana Requests (Public Incoming)
		} elseif( $data instanceof Kohana_Request ) {
			$this
				->setCode( '200' )
				->setBody( $data->body() )
				->setHeaders( $data->headers()->getArrayCopy() )
				->setFormat( $this->getHeader('content-type') )
				->setMethod( $data->method() )
				->setRequestUri( $data->url($_GET) );
		}
//		Kohana::$log->add(LOG_DEBUG, "Format detected [Packet]: ".$this->getHeader('content-type') );
	}
	public function __toString()
	{
		switch( $this->getFormat() ) {
			case 'application/xml':
			case 'text/xml':
			case 'xml':
				return $this->_toXml();
				break;
			case 'application/json':
			case 'json':
			default:
				return $this->_toJson();
				break;
		}
	}
	public function setBody($body)
	{
		$this->_body = $this->_extractData($body);
		return $this;
	}
	public function getBody()
	{
		return $this->_body;
	}
	public function setCode( $code )
	{
		$this->_code = $code;
		return $this;
	}
	public function getCode()
	{
		return $this->_code;
	}
	public function setFormat($format)
	{
		if( strstr(';',$format) ) {
			list( $format, $trash ) = explode(';',$format,2);
		}
		$this->_format = $format;
		return $this;
	}
	public function getFormat()
	{
		return $this->_format;
	}
	public function setHeader($header,$value)
	{
		$header = strtolower( $header );
		$this->_headers[$header] = $value;
		return $this;
	}
	public function getHeader($header,$default=null)
	{
		$header = strtolower($header);
		if( is_array( $this->_headers ) ) {
			if( array_key_exists($header, $this->_headers)) {
				return $this->_headers[$header];
			}
		} elseif( !is_null($default) ) {
			return $default;
		}
		return null;
	}
	public function setHeaders($headers,$merge=false)
	{
		$_value = '';
		foreach( $headers as $h=>$v ) {
			if( is_object($v) ) {
				if( property_exists($v,'value') )
					$_headers[ strtolower($h) ] = ($v->key?$v->key.'=':'').$v->value;
			} elseif( is_array($v) ) {
				foreach($v as $_vk=>$_vv) {
					if( property_exists($_vv,'value') )
						$_value.=($_vv->key?$$_vv->key.'=':'').$_vv->value.', ';
				}
				$_headers[ strtolower($h) ] = trim($_value);
			} else {
				$_headers[ strtolower($h) ] = $v;
			}
		}
		if( array_key_exists('authorization',$_headers) AND
			$_headers['authorization']=='Basic Og==' ) {
			unset( $_headers['authorization'] );
		}
		if( $merge ) {
			$this->_headers = array_merge(
				$this->_headers,
				$_headers
			);
		} else {
			$this->_headers = $_headers;
		}
		return $this;
	}
	public function getHeaders()
	{
		$args = func_get_args();
		if( count($args)>1 ) {
			foreach( $this->_headers as $h=>$v ) {
				if( in_array($h, $args) )
					$_headers[$h] = $v;
			}
			return $_headers;
		} elseif( is_array($args[0]) ) {
			foreach( $args[0] as $h=>$v ) {
				if( in_array($h, $args) )
					$_headers[$h] = $v;
			}
			return $_headers;
		}
		return $this->_headers;
	}
	public function setAuthorizationHeader($user,$pw)
	{
		if(strlen($user)>2 AND strlen($pw)>2)
			$this->setHeader('Authorization', base64_encode($user.':'.$pw));
		return $this;
	}
	public function setMethod($method)
	{
		$this->_method = strtolower($method);
		return $this;
	}
	public function getMethod()
	{
		return $this->_method;
	}
	public function setRequestUri($uri)
	{
		$this->_request_uri = $uri;
		return $this;
	}
	public function getRequestUri()
	{
		return $this->_request_uri;
	}
	public function setError($type,$location)
	{
		$error = new stdClass();
		$error->reason = $type;
		$error->location = $location;
		$this->setBody(array(
			'errors' => array(
				'item' => $error
			)
		));
		return $this;
	}
	public function output($format=null)
	{
		if( !is_null($format) )
			$this->setFormat($format);
		return $this->__toString();
	}
	public function getVariable($name, $input=null)
	{
		if( is_null($input) )
			$input = $this->getBody();
	}
	protected function _toJson()
	{
		Kohana::$log->add(LOG_DEBUG, 'Outputting request using JSON format.');
		$body = $this->getBody();
		$body = json_encode( $body );
		$body = str_replace( array( '\n' ), '', $body );
//		$body = stripslashes( $body );
		Kohana::$log->add(LOG_DEBUG, 'Final body:'.print_r($body,true));
		return $body;
	}
	protected function _outputFilterJson()
	{
		
	}
	protected function _toXml()
	{
		Kohana::$log->add(LOG_DEBUG, 'Outputting request using XML format.');
		$xml = new XMLWriter();
		$xml->openMemory();
		$xml->startDocument('1.0', 'UTF-8');
		$xml->startElement($this->_root_node);
		$this->_outputFilterXml($xml, $this->getBody());
		$xml->endElement();
		return $xml->outputMemory();
	}
	/**
	 * Reformat objects and arrays into nested
	 * array format.
	 * @param XMLWriter $xml
	 * @param mixed $data
	 * @return bool
	 */
	protected function _outputFilterXml(XMLWriter $xml, $data)
	{
		if( is_object($data) ) {
			$data = get_object_vars($data);
		}
		if( is_array($data) ) {
			foreach( $data as $key=>$value ) {
				$key = $this->_camelCase($key);
				if( is_string($value) OR is_int($value) ) {
					if( in_array($key, array('aliases','device_tokens','tags','exclude_tokens')) ) {
						$xml->startElement($key);
						$xml->writeElement($value,$value);
						$xml->writeElement($value,$value);
						$xml->endElement();
					} else {
						$xml->writeElement($key, $value);
					}
				} elseif( is_array($value) ) {
					if( count( $value )>0 ) {
						if( is_object($value[0]) ) {
							foreach( $value as $subvalue ) {
								$xml->startElement($key);
								$this->_outputFilterXml($xml, $subvalue);
								$xml->endElement();
							}
						} else {
							foreach( $value as $subvalue ) {
								$xml->writeElement($key, $subvalue);
							}
						}
					} else {
						$xml->startElement($key);
						$xml->endElement();
					}
				} elseif( is_object($value) ) {
					$xml->startElement($key);
					$this->_outputFilterXml($xml, $value);
					$xml->endElement();
				}
			}
		} else {
			return false;
		}
		return true;
	}
	/**
	 * Depending on the selected format, prepare the
	 * case of a given key string and return it.
	 * @param string $input
	 * @return string
	 */
	protected function _fixCase($input)
	{
		switch($this->getFormat()) {
			case 'xml':
				return $this->_camelCase($input);
				break;
			case 'json':
				return $this->_separatedCase($input);
				break;
			default:
				return $input;
				break;
		}
	}
	/**
	 * Process an input string and convert it
	 * into camel case format.
	 * @param string $string
	 * @param string|null $separator
	 * @param bool|null $lcfirst
	 * @return string
	 */
	protected function _camelCase( $string, $separator='_', $lcfirst=true )
	{
		$string = str_replace($separator,' ',$string);
		$string = ucwords( $string );
		$string = str_replace(' ','',$string);
		if( $lcfirst ) {
			$string = strtolower( substr( $string, 0, 1 ) ).substr($string, 1);
		}
		return $string;
	}
	/**
	 * Process an input string and convert it
	 * into a separator format.
	 * @param string $string
	 * @param string|null $separator
	 * @return string
	 */
	protected function _separatedCase( $string, $separator='_', $forceLower=true )
	{
		$string = ucfirst( $string );
		preg_match_all( '/([A-Z][a-z0-9]*)/', $string, $matches );
		$string = implode( $separator, $matches[1] );
		if( $forceLower )
			$string = strtolower( $string );
		return $string;
	}
	public function getDataVar($name)
	{
		return $this->_extractInputVariable($name, $this->getBody());
	}
	/**
	 * Deep value extraction function.  Searches objects,
	 * arrays and several string formats for nested data
	 * values with the necessary key.  Returns first exact
	 * matching result.
	 * @todo Add recursion limit (max-depth)
	 * @todo Add offset option (skip first 2 matches)
	 * @param string $name
	 * @param mixed $input
	 * @return mixed
	 */
	protected function _extractInputVariable($name, $input)
	{
		if( is_object($input) ) {
			$vars = get_object_vars( $input );
			// {name} property check
			if( property_exists($input, $name) ) {
				return $input->$name;
			// {name} method check
			} elseif( method_exists($input, $name) ) {
				return $input->$name();
			// get{Name} method check
			} elseif( method_exists($input, 'get'.ucfirst( $name )) ) {
				$mName = 'get'.ucfirst($name);
				return $input->$mName();
			} else {
				// Check children
				foreach( $vars as $key=>$value ) {
					$result = self::_extractInputVariable($name,$value);
					if( $result!==$value ) return $result;
				}
			}
		} elseif( is_array($input) ) {
			if( array_key_exists($name, $input) ) {
				return $input[$name];
			} else {
				// Check children
				foreach( $input as $key=>$value ) {
					$result = self::_extractInputVariable($name,$value);
					if( $result!==$value ) return $result;
				}
			}
		} elseif( is_string($input) ) {
			$input = trim($input);
			// Quick id for JSON
			if( substr($input, 0, 1)=='{' and
				substr($input, -1)=='}' ) {
				$json = json_decode($input);
				$result = self::_extractInputVariable($name, $json);
				if( $json!==$result ) return $result;
			// Quick id for XML
			} elseif( strstr($input,'<?xml') or
				substr($input,0,2)=='<?' ) {
				$xml = simplexml_load_string($input,null,LIBXML_NOCDATA);
				$result = self::_extractInputVariable($name, $xml);
				if( $xml!==$result ) return $result;
			// General string guessing
			} elseif( strstr($name, $input) ) {
				$string = parse_str($input);
				$result = self::_extractInputVariable($name, $string);
				if( $string!==$result ) return $result;
			}
		}
		return $input;
	}
	/**
	 * Parses input into a fully realized object, in an
	 * attempt to produce a semi-standardized data
	 * collection for generic processing calls.
	 * @param object|array|string|mixed $input
	 * @param int|null $depth
	 * @return mixed
	 */
	protected function _extractData($input,$depth=1)
	{
//		Kohana::$log->add(LOG_DEBUG, "Entering data extraction cycle".($depth>0?" [".$depth."]":''));
		if( is_object($input) ) {
//			Kohana::$log->add(LOG_DEBUG, "Object Detected");
			$output = new stdClass();
			$vars = get_object_vars( $input );
			if( count($vars)>0 ) {
				foreach( $vars as $key=>$value ) {
					if( $key=='body' ) {
						$output->$key = $value;
					} elseif( $key=='@attributes' ) {
						foreach( $value as $i=>$v ) {
							$i = $this->_fixCase($i);
							$output->$i = $this->_extractData($v,$depth+1);
						}
					} else {
						$key = $this->_fixCase($key);
						$dValue = $this->_extractData($value,$depth+1);
						if( is_string($dValue) AND
							in_array($key,$this->_force_array) ) {
							$output->$key = array($dValue);
						} else {
							$output->$key = $dValue;
						}
					}
				}
			} else {
				$output = null;
			}
		} elseif( is_array($input) ) {
//			Kohana::$log->add(LOG_DEBUG, "Array Detected");
			$output = array();
			foreach( $input as $key=>$value ) {
				$key = $this->_fixCase($key);
				$output[$key] = $this->_extractData($value,$depth+1);
			}
		} elseif( is_int($input) ) {
			$output = intval($intput);
		} elseif( is_string($input) ) {
			$input = trim($input);
			if( substr($input, 0, 1)=='{' AND
				substr($input, -1)=='}' ) {
//				Kohana::$log->add(LOG_DEBUG, "JSON String Detected: ".$input);
				$json = json_decode($input);
				$output = $this->_extractData($json,$depth++);
			} elseif( strstr(strtolower($input),'<?xml') OR
				substr($input,0,2)=='<?' ) {
//				Kohana::$log->add(LOG_DEBUG, "XML String Detected: ".$input);
				$xml = simplexml_load_string($input,null,LIBXML_NOCDATA);
				$output = $this->_extractData($xml,$depth++);
			} elseif( strstr($input, '&') OR
				strstr(substr($input,0,-2), '=') ) {
//				Kohana::$log->add(LOG_DEBUG, "Query String Detected: ".$input);
				parse_str($input, $vars);
				if( is_array($vars) ) {
					$output = $this->_extractData($vars,$depth+1);
				} else {
					$output = $this->_extractData($input,$depth+1);
				}
			} else {
//				Kohana::$log->add(LOG_DEBUG, "Unformatted Text Detected: ".$input);
				$output = $input;
			}
		} else {
			$output = false;
		}
		return $output;
	}
}
