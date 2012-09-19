<?php defined('SYSPATH') or die('No direct script access!');
/**
 * Specific adapter class for utilizing Urban
 * Airship services compliant with adapter
 * abstraction interface stipulations.
 * @author James Zimmerman II
 */
class Notification_Adapter_Urbanairship extends Kohana_Notification_Adapter_Abstract
{
	/**
	 * Raw logic that performs the request, taking generic
	 * input and filtering it into the necessary format to
	 * pass on to the server provided services, returning
	 * the raw response to the original caller.
	 * @param string		$target
	 * @param string		$payload
	 * @param string|null	$type
	 * @param string|null	$auth
	 * @return string|mixed
	 */
	protected function _request($target, $payload=null, $type=null)
	{
		if( is_null($payload) ) 	$payload = $this->getParameter('raw');
		if( !is_string($payload) )	$payload = json_encode($payload);
		if( $type==null )			$type	 = Request::current()->method();
		if( substr($target,-1)!='/') $target.='/';
		$client = new Zend_Http_Client();
		$client
			->setUri($this->getBaseUri().$target)
			->setMethod(strtoupper($type))
			->setHeaders('Content-Type','application/json')
			->setHeaders('User-Agent','Urban Airship Client Adapter');
		if( $auth = $this->_getHeader('Authorization') ) {
			$client->setHeaders('Authorization',$auth);
		}
		if( !is_null($payload) AND !empty($payload) ) {
			$client->setRawData($payload);
		} else {
			$client->setRawData('');
		}
//		Kohana::$log->add(LOG_DEBUG, 'UA Request Client: '.print_r($client,true));
		$client->request();
//		Kohana::$log->add(LOG_DEBUG, "Request:\n".print_r( $client->getLastRequest(), true )."\n---------------------------" );
//		Kohana::$log->add(LOG_DEBUG, "Response:\n".print_r( $client->getLastResponse()->asString(), true )."\n---------------------------" );
//		Kohana::$log->add(LOG_DEBUG, "Response Body:\n".( $client->getLastResponse()->getBody()) );
		return $client->getLastResponse();
	}
	protected function _deviceCreate()
	{
		Kohana::$log->add(LOG_INFO, 'Creating notification device record [Urban Airship].');
		return $this->_request(
			$this->getRequest(),
			null,
			'PUT'
		);
	}
	protected function _deviceList()
	{
		Kohana::$log->add(LOG_INFO, 'Listing notification device records [Urban Airship].');
		return $this->_request(
			$this->getRequest(),
			null,
			'GET'
		);
	}
	protected function _deviceDetails()
	{
		Kohana::$log->add(LOG_INFO, 'Listing notification device details [Urban Airship].');
		return $this->_request(
			$this->getRequest(),
			null,
			'GET'
		);
	}
	protected function _deviceCount()
	{
		Kohana::$log->add(LOG_INFO, 'Counting notification device records [Urban Airship].');
		return $this->_request(
			$this->getRequest(),
			null,
			'GET'
		);
	}
	protected function _deviceFeedback()
	{
		Kohana::$log->add(LOG_INFO, 'Retrieving notification device feedback [Urban Airship].');
		return $this->_request(
			$this->getRequest(),
			null,
			'GET'
		);
	}
	protected function _deviceUpdate()
	{
		Kohana::$log->add(LOG_INFO, 'Updating notification device details [Urban Airship].');
		return $this->_request(
			$this->getRequest(),
			null,
			'PUT'
		);
	}
	protected function _deviceTagAdd()
	{
		Kohana::$log->add(LOG_INFO, 'Adding notification device tag association [Urban Airship].');
		return $this->_request(
			$this->getRequest(),
			null,
			'PUT'
		);
	}
	protected function _deviceTagRemove()
	{
		Kohana::$log->add(LOG_INFO, 'Removing notification device tag association [Urban Airship].');
		return $this->_request(
			$this->getRequest(),
			null,
			'DELETE'
		);
	}
	protected function _deviceRemove()
	{
		Kohana::$log->add(LOG_INFO, 'Removing notification device record [Urban Airship].');
		return $this->_request(
			$this->getRequest(),
			null,
			'PUT'
		);
	}
	protected function _userCreate()
	{
		Kohana::$log->add(LOG_INFO, 'Creating mobile mail user record [Urban Airship].');
		return $this->_request(
			$this->getRequest(),
			null,
			'POST'
		);
	}
	protected function _userList()
	{
		Kohana::$log->add(LOG_INFO, 'Listing mobile mail user records [Urban Airship].');
		return $this->_request(
			$this->getRequest(),
			null,
			'GET'
		);
	}
	protected function _userReset()
	{
		Kohana::$log->add(LOG_INFO, 'Resetting mobile mail user record [Urban Airship].');
		return $this->_request(
			$this->getRequest(),
			null,
			'POST'
		);
	}
	protected function _userUpdate()
	{
		Kohana::$log->add(LOG_INFO, 'Updating mobile mail user record [Urban Airship].');
		return $this->_request(
			$this->getRequest(),
			null,
			'PUT'
		);
	}
	protected function _userRemove()
	{
		Kohana::$log->add(LOG_INFO, 'Removing mobile mail user record [Urban Airship].');
		return $this->_request(
			$this->getRequest(),
			null,
			'DELETE'
		);
	}
	protected function _tagCreate()
	{
		Kohana::$log->add(LOG_INFO, 'Creating tag reference record [Urban Airship].');
		return $this->_request(
			$this->getRequest(),
			null,
			'PUT'
		);
	}
	protected function _tagList()
	{
		Kohana::$log->add(LOG_INFO, 'Retrieving tag references [Urban Airship].');
		return $this->_request(
			$this->getRequest(),
			null,
			'GET'
		);
	}
	protected function _tagDetails()
	{
		Kohana::$log->add(LOG_INFO, 'Retrieving tag reference details [Urban Airship].');
		return $this->_request(
			$this->getRequest(),
			null,
			'GET'
		);
	}
	protected function _tagUpdate()
	{
		Kohana::$log->add(LOG_INFO, 'Updating tag reference details [Urban Airship].');
		return $this->_request(
			$this->getRequest(),
			null,
			'POST'
		);
	}
	protected function _tagRemove()
	{
		Kohana::$log->add(LOG_INFO, 'Removing tag reference [Urban Airship].');
		return $this->_request(
			$this->getRequest(),
			null,
			'DELETE'
		);
	}
	protected function _pushNotification()
	{
		Kohana::$log->add(LOG_INFO, 'Creating push notification message [Urban Airship].');
		return $this->_request(
			$this->getRequest(),
			null,
			'POST'
		);
	}
	protected function _pushBroadcast()
	{
		Kohana::$log->add(LOG_INFO, 'Creating broadcast push notification message [Urban Airship].');
		return $this->_request(
			$this->getRequest(),
			null,
			'POST'
		);
	}
	protected function _pushStats()
	{
		Kohana::$log->add(LOG_INFO, 'Retrieving push notification statistics [Urban Airship].');
		return $this->_request(
			$this->getRequest(),
			null,
			'GET'
		);
	}
	protected function _mobileMailNotification()
	{
		Kohana::$log->add(LOG_INFO, 'Creating mobile mail notification [Urban Airship].');
		return $this->_request(
			$this->getRequest(),
			null,
			'POST'
		);
	}
	protected function _mobileMailBroadcast()
	{
		Kohana::$log->add(LOG_INFO, 'Creating broadcast mobile mail notification [Urban Airship].');
		return $this->_request(
			$this->getRequest(),
			null,
			'POST'
		);
	}
	protected function _mobileMailMessageList()
	{
		Kohana::$log->add(LOG_INFO, 'Retrieving mobile mail message headers [Urban Airship].');
		return $this->_request(
			$this->getRequest(),
			null,
			'GET'
		);
	}
	protected function _mobileMailMessageBody()
	{
		Kohana::$log->add(LOG_INFO, 'Retrieving mobile mail message headers [Urban Airship].');
		return $this->_request(
			$this->getRequest(),
			null,
			'GET'
		);
	}
	protected function _mobileMailMessageStatus()
	{
		Kohana::$log->add(LOG_INFO, 'Updating mobile mail message status [Mobile Storm].');
		return false;
	}
	protected function _mobileMailDeleteMessage()
	{
		Kohana::$log->add(LOG_INFO, 'Delete mobile mail message [Urban Airship].');
		return $this->_request(
			$this->getRequest(),
			null,
			'DELETE'
		);
	}
	protected function _applicationCreate()
	{
		Kohana::$log->add(LOG_INFO, 'Creating urban airship application record [Urban Airship].');
		return $this->_request(
			$this->getRequest(),
			null,
			'POST'
		);
	}
	protected function _applicationList()
	{
		Kohana::$log->add(LOG_INFO, 'Retrieving urban airship application records [Urban Airship].');
		return $this->_request(
			$this->getRequest(),
			null,
			'GET'
		);
	}
	protected function _applicationDetails()
	{
		Kohana::$log->add(LOG_INFO, 'Retrieving urban airship application details [Urban Airship].');
		return $this->_request(
			$this->getRequest(),
			null,
			'GET'
		);
	}
	protected function _applicationUpdate()
	{
		Kohana::$log->add(LOG_INFO, 'Updating urban airship application record [Urban Airship].');
		return $this->_request(
			$this->getRequest(),
			null,
			'POST'
		);
	}
	protected function _applicationRemove()
	{
		Kohana::$log->add(LOG_INFO, 'Removing urban airship application record [Urban Airship].');
		return $this->_request(
			$this->getRequest(),
			null,
			'DELETE'
		);
	}
	protected function _secureData($data,$data2=null)
	{
		$i_vector	= 1234567890123456;
		$key		= substr( str_repeat( uniqid( true ), 4 ), 0, 32 );
		$salt		= substr( hash_hmac( 'sha256', '4d93a499659e93199500c9c94d93a499659e93199500c9c9', ''), 0, 16 );
		$key_pad_s	= ( strlen( $key ) % 16 ? 16 - ( strlen( $key ) % 16 ) : 16 );
		$key_pad	= substr( str_repeat( $key_pad_s, $key_pad_s ), 0, $key_pad_s );
		$pad_size	= ( strlen( $data ) % 16 ? 16 - ( strlen( $data ) % 16 ) : 16 );
		$pad		= substr( str_repeat( $pad_size, $pad_size ), 0, $pad_size );
		$message	= openssl_encrypt( $data.$pad, 'aes-256-cbc', $key, true, $i_vector );
		$enc_key	= openssl_encrypt( $key.$key_pad, 'aes-256-cbc', '4d93a499659e93199500c9c94d93a499659e93199500c9c9', true, $i_vector );
		if( $data2 ) {
			$sub_pad_s	= ( strlen( $data2 ) % 16 ? 16 - ( strlen( $data2 ) % 16 ) : 16 );
			$sub_pad	= substr( str_repeat( $sub_pad_s, $sub_pad_s ), 0, $sub_pad_s );
			$subject	= openssl_encrypt( $data2.$sub_pad_s, 'aes-256-cbc', $key, true, $i_vector );
		} else {
			$subject	= $data2;
		}
		return array(
			'key'		=> $enc_key,
			'message'	=> $message,
			'subject'	=> $subject
		);
	}

}