<?php


class Curl
{

	/**
	 * @var resource
	 */
	protected $_ch;


	public function __construct($url = null)
	{
		$this->init($url);
	}

	public function __destruct()
	{
		$this->close();
	}

	public function resource()
	{
		return $this->_ch;
	}


	/**
	 * Close a cURL session
	 *
	 * @return void
	 */
	public function close()
	{
		if ($this->_ch) {
			curl_close($this->_ch);
			$this->_ch = null;
		}
	}

	/**
	 * Copy a cURL handle along with all of its preferences
	 *
	 * @return resource
	 */
	public function copy_handle()
	{
		return curl_copy_handle($this->_ch);
	}

	/**
	 * Return the last error number
	 *
	 * @return integer
	 */
	public function errno()
	{
		return curl_errno($this->_ch);
	}

	/**
	 * Return a string containing the last error for the current session
	 *
	 * @return string
	 */
	public function error()
	{
		return curl_error($this->_ch);
	}

	/**
	 * URL encodes the given string
	 *
	 * @param string $str
	 * @return string
	 */
	public function escape($str)
	{
		return curl_escape($this->_ch, $str);
	}

	/**
	 * Perform a cURL session
	 *
	 * @return mixed
	 */
	public function exec()
	{
		return curl_exec($this->_ch);
	}

	/**
	 * Create a CURLFile object
	 */
	public function file_create()
	{
		return call_user_func_array('curl_file_create', func_get_args());
	}

	/**
	 * Get information regarding a specific transfer
	 *
	 * @param integer $opt
	 * @return mixed
	 */
	public function getinfo($opt = 0)
	{
		return curl_getinfo($this->_ch, $opt);
	}

	/**
	 * Initialize a cURL session
	 *
	 * @param string $url
	 * @return Curl
	 */
	public function init($url = null)
	{
		$this->_ch = curl_init($url);
		return $this;
	}

	/**
	 * Pause and unpause a connection
	 *
	 * @param integer $bitmask
	 * @return integer
	 */
	public function pause($bitmask)
	{
		return curl_pause($this->_ch, $bitmask);
	}

	/**
	 * Reset all options of a libcurl session handle
	 *
	 * @return void
	 */
	public function reset()
	{
		return curl_reset($this->_ch);
	}

	/**
	 * Set multiple options for a cURL transfer
	 *
	 * @param array $options
	 * @return boolean
	 */
	public function setopt_array(array $options)
	{
		$options = array_map(array($this, '_force_resource'), $options);

		return curl_setopt_array($this->_ch, $options);
	}

	/**
	 * Set an option for a cURL transfer
	 *
	 * @param integer $option
	 * @param mixed $value
	 * @return boolean
	 */
	public function setopt($option, $value)
	{
		$value = $this->_force_resource($value);

		return curl_setopt($this->_ch, $option, $value);
	}

	/**
	 * Return string describing the given error code
	 *
	 * @param integer $errornum
	 * @return string
	 *
	 */
	public function strerror($errornum)
	{
		return curl_strerror($this->_ch, $errornum);
	}

	/**
	 * Decodes the given URL encoded string
	 *
	 * @param string $str
	 * @return string
	 */
	public function unescape($str)
	{
		return curl_unescape($this->_ch, $str);
	}

	/**
	 * Gets cURL version information
	 *
	 * @param interger $age
	 * @return array
	 */
	public function version($age = CURLVERSION_NOW)
	{
		return curl_version($age);
	}


	protected function _force_resource($value)
	{
		if ($value instanceof Curl
			|| $value instanceof CurlMulti
			|| $value instanceof CurlShare
		) {
			$value = $value->resource();
		}
		return $value;
	}

}
