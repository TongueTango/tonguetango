<?php defined('SYSPATH') or die('No direct script access!');

class Kohana_Notification_Request
{
	protected $_body;
	protected $_format;
	protected $_headers = array();
	protected $_method;
	protected $_request_uri;
	public function __construct()
	{
		
	}
	public function __toString()
	{
		switch( $this->getFormat() ) {
			case 'xml':
				return $this->_toXml();
				break;
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
	public function setFormat($format)
	{
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
	public function getHeader($header)
	{
		if( array_key_exists($header, $this->_headers)) {
			return $this->_headers[$header];
		}
		return null;
	}
	public function setHeaders(array $headers,$merge=false)
	{
		if( $merge ) {
			$this->_headers = array_merge(
				$this->_headers,
				$headers
			);
		} else {
			$this->_headers = $headers;
		}
		return $this;
	}
	public function getHeaders()
	{
		return $this->_headers;
	}
	public function setMethod($method)
	{
		$this->_method = $method;
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
		$body = json_encode($this->getBody());
		$body = str_replace( array( '\n', ' '), '', $body );
		$body = stripslashes( $body );
		return $body;
	}
	protected function _toXml()
	{
		Kohana::$log->add(LOG_DEBUG, 'Outputting request using XML format.');
		$xml = new XMLWriter();
		$xml->openMemory();
		$xml->startDocument('1.0', 'UTF-8');
		$xml->startElement('response');
		$this->_outputWriteXml($xml, $this->getBody());
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
	protected function _outputWriteXml(XMLWriter $xml, $data)
	{
		if( is_object($data) ) {
			$data = get_object_vars($data);
		}
		if( is_array($data) ) {
			foreach( $data as $key=>$value ) {
				$key = $this->_camelCase($key);
				if( !is_object($value) AND !is_array($value) ) {
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
								$this->_outputWriteXml($xml, $subvalue);
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
					$this->_outputWriteXml($xml, $value);
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
				return $this->_underscoreCase($input);
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
			if( property_exists($input, $name) ) {
				return $input->$name;
			} elseif( method_exists($input, $name) ) {
				return $input->$name();
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
			// Quick id for JSON
			if( substr($input, 0, 1)=='{' and
				substr($input, -1)=='}' ) {
				$json = json_decode($input);
				$result = self::_extractInputVariable($name, $json);
				if( $json!==$result ) return $result;
			// Quick id for XML
			} elseif( strstr($input,'<?xml') or
				substr(trim($input),0,1)=='<' ) {
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
	 * @return mixed
	 */
	protected function _extractData($input)
	{
		if( is_object($input) ) {
			Kohana::$log->add(LOG_DEBUG, "Object Detected");
			$output = new stdClass();
			$vars = get_object_vars( $input );
			if( count($vars)>0 ) {
				foreach( $vars as $key=>$value ) {
					if( $key=='@attributes' ) {
						foreach( $value as $i=>$v ) {
							$i = $this->_fixCase($i);
							$output->$i = $this->_extractData($v);
						}
					} else {
						$key = $this->_fixCase($key);
						$output->$key = $this->_extractData($value);
					}
				}
			} else {
				$output = null;
			}
		} elseif( is_array($input) ) {
			Kohana::$log->add(LOG_DEBUG, "Array Detected");
			$output = array();
			foreach( $input as $key=>$value ) {
				$key = $this->_fixCase($key);
				$output[$key] = $this->_extractData($value);
			}
		} elseif( is_string($input) ) {
			if( substr($input, 0, 1)=='{' AND
				substr($input, -1)=='}' ) {
				Kohana::$log->add(LOG_DEBUG, "JSON Detected");
				$json = json_decode($input);
				$output = $this->_extractData($json);
			} elseif( strstr($input,'<?xml') OR
				substr(trim($input),0,1)=='<' ) {
				Kohana::$log->add(LOG_DEBUG, "XML Detected");
				$xml = simplexml_load_string($input,null,LIBXML_NOCDATA);
				$output = $this->_extractData($xml);
			} else {
				Kohana::$log->add(LOG_DEBUG, "String Detected");
				$output = $input;
			}
		}
		return $output;
	}
}