<?php defined('SYSPATH') or die('No direct script access!');

abstract class Kohana_Notification_Adapter_Abstract implements Kohana_Notification_Adapter_Interface
{
	protected $_request;
	protected $_parameters = array();
	protected $_config;
	protected $_headers;
	public function __construct($config=null)
	{
		if( !is_null($config) ) {
			$this->setConfig($config);
		}
	}
	public function request()
	{
		$args = func_get_args();
		return call_user_func_array(array('self', '_request'),$args);
	}
	public function setConfig( $config )
	{
		$this->_config = $config;
		return $this;
	}
	public function getConfig()
	{
		if( !is_array($this->_config) )
			throw new Exception("Adapter configuration not yet defined!");
		return $this->_config;
	}
	public function setRequest( $request )
	{
		$this->_request = $request;
		return $this;
	}
	public function getRequest()
	{
		return $this->_request;
	}
	public function setParameters( $raw=null, $get=null, $post=null )
	{
		$this->_parameters['raw']	= $raw;
		$this->_parameters['get']	= $get;
		$this->_parameters['post']	= $post;
		return $this;
	}
	public function getParameter($name='raw'){
		return $this->_parameters[$name];
	}
	public function getRawBody()
	{
		return $this->getParameter('raw');
	}
	public function getQueryString()
	{
		return http_build_query($this->getParameter('get'));
	}
	public function getPostData()
	{
		return $this->getParameter('post');
	}
	public function setBaseUri($uri)
	{
		$config = $this->getConfig();
		$config['base_uri'] = $uri;
		return $this;
	}
	public function getBaseUri()
	{
		$config = $this->getConfig();
		if( !array_key_exists('base_uri', $config) )
			throw new Exception("Configuration does not contain base URI value (base_uri)!");
		return $config['base_uri'];
	}
	protected function _getBody()
	{
		
	}
	/**
	 * Helper method to filter JSON based input into an
	 * appropriately usable data collection.
	 * @return array|null
	 */
	public function _inputJson()
	{
//		Kohana::$log->add(LOG_DEBUG, 'Using JSON format for input.');
		// @todo handle XML input as well as JSON
		if( Request::initial()->body() ) {
			$rawBody = stripslashes( Request::initial()->body() );
			$body = json_decode( $rawBody );
			return $body;
		} else {
			return new stdClass();
		}
	}
	/**
	 * Helper method to filter XML based input into an
	 * appropriately usable data collection.
	 * @return array|null
	 */
	public function _inputXml()
	{
//		Kohana::$log->add(LOG_DEBUG, 'Using XML format for input.');
		if( Request::initial()->body() ) {
			$rawBody = stripslashes( Request::initial()->body() );
//			Kohana::$log->add(LOG_DEBUG, print_r($rawBody,true));
			$body = simplexml_load_string( $rawBody,null,LIBXML_NOCDATA );
			// @todo catch fields with single value that should be arrays
			return $body;
		} else {
			return new stdClass();
		}
	}
	/**
	 * Custom header fetcher, since there is inconsistent
	 * cases on results and Kohana's default is not
	 * broad-based enough.
	 * @param string $header
	 * @return string|null
	 */
	protected function _getHeader($header)
	{
		$header = strtolower($header);
		// Cache headers upon first request.
		if( !is_array($this->_headers) ) {
			$headers = Request::current()->headers();
			foreach( $headers as $key=>$value ) {
				$this->_headers[strtolower($key)] = $value;
			}
		}
//		Kohana::$log->add(LOG_DEBUG,"Retrieving header: ".$header);
		if( array_key_exists($header, $this->_headers) ) {
//			Kohana::$log->add(LOG_DEBUG,"Retrieved header value: ".$this->_headers[$header]);
			return $this->_headers[$header];
		}
		return null;
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
	 * into underscore format.
	 * @param string $string
	 * @param string|null $separator
	 * @return string
	 */
	protected function _underscoreCase( $string, $separator='_' )
	{
		$string = ucfirst( $string );
		preg_match_all( '/([A-Z][a-z0-9]*)/', $string, $matches );
		$string = strtolower( implode( $separator, $matches[1] ) );
		return $string;
	}
	public function deviceCreate()
	{
		return $this->_deviceCreate();
	}
	abstract protected function _deviceCreate();
	public function deviceList()
	{
		return $this->_deviceList();
	}
	abstract protected function _deviceList();
	public function deviceDetails()
	{
		return $this->_deviceDetails();
	}
	abstract protected function _deviceDetails();
	public function deviceCount()
	{
		return $this->_deviceCount();
	}
	abstract protected function _deviceCount();
	public function deviceFeedback()
	{
		return $this->_deviceFeedback();
	}
	abstract protected function _deviceFeedback();
	public function deviceUpdate()
	{
		return $this->_deviceUpdate();
	}
	abstract protected function _deviceUpdate();
	public function deviceTagAdd()
	{
		return $this->_deviceTagAdd();
	}
	abstract protected function _deviceTagAdd();
	public function deviceTagRemove()
	{
		return $this->_deviceTagRemove();
	}
	abstract protected function _deviceTagRemove();
	public function deviceRemove()
	{
		return $this->_deviceRemove();
	}
	abstract protected function _deviceRemove();
	public function userCreate()
	{
		return $this->_userCreate();
	}
	abstract protected function _userCreate();
	public function userList()
	{
		return $this->_userList();
	}
	abstract protected function _userList();
	public function userReset()
	{
		return $this->_userReset();
	}
	abstract protected function _userReset();
	public function userUpdate()
	{
		return $this->_userUpdate();
	}
	abstract protected function _userUpdate();
	public function userRemove()
	{
		return $this->_userRemove();
	}
	abstract protected function _userRemove();
	public function tagCreate()
	{
		return $this->_tagCreate();
	}
	abstract protected function _tagCreate();
	public function tagList()
	{
		return $this->_tagList();
	}
	abstract protected function _tagList();
	public function tagDetails()
	{
		return $this->_tagDetails();
	}
	abstract protected function _tagDetails();
	public function tagUpdate()
	{
		return $this->_tagUpdate();
	}
	abstract protected function _tagUpdate();
	public function tagRemove()
	{
		return $this->_tagRemove();
	}
	abstract protected function _tagRemove();
	public function pushNotification()
	{
		return $this->_pushNotification();
	}
	abstract protected function _pushNotification();
	public function pushBroadcast()
	{
		return $this->_pushBroadcast();
	}
	abstract protected function _pushBroadcast();
	public function pushStats()
	{
		return $this->_pushStats();
	}
	abstract protected function _pushStats();
	public function mobileMailNotification()
	{
		return $this->_mobileMailNotification();
	}
	abstract protected function _mobileMailNotification();
	public function mobileMailBroadcast()
	{
		return $this->_mobileMailBroadcast();
	}
	abstract protected function _mobileMailBroadcast();
	public function mobileMailMessageList()
	{
		return $this->_mobileMailMessageList();
	}
	abstract protected function _mobileMailMessageList();
	public function mobileMailMessageBody()
	{
		return $this->_mobileMailMessageBody();
	}
	abstract protected function _mobileMailMessageBody();
	public function mobileMailMessageStatus()
	{
		return $this->_mobileMailMessageStatus();
	}
	abstract protected function _mobileMailMessageStatus();
	public function mobileMailDeleteMessage()
	{
		return $this->_mobileMailDeleteMessage();
	}
	abstract protected function _mobileMailDeleteMessage();
	public function applicationCreate()
	{
		return $this->_applicationCreate();
	}
	abstract protected function _applicationCreate();
	public function applicationList()
	{
		return $this->_applicationList();
	}
	abstract protected function _applicationList();
	public function applicationUpdate()
	{
		return $this->_applicationUpdate();
	}
	abstract protected function _applicationUpdate();
	public function applicationDetails()
	{
		return $this->_applicationDetails();
	}
	abstract protected function _applicationDetails();
	public function applicationRemove()
	{
		return $this->_applicationRemove();
	}
	abstract protected function _applicationRemove();
}