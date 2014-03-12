<?php


class CurlMulti
{

	/**
	 * @var resource
	 */
	protected $_mh;


	public function __construct()
	{
		$this->init();
	}

	public function __destruct()
	{
		$this->close();
	}

	public function resource()
	{
		return $this->_mh;
	}


	/**
	 * Add a normal cURL handle to a cURL multi handle
	 *
	 * @param Curl|resource $ch
	 * @return integer
	 */
	public function add_handle($ch)
	{
		if ($ch instanceof Curl) {
			$ch = $ch->resource();
		}
		return curl_multi_add_handle($this->_mh, $ch);
	}

	/**
	 * Close a set of cURL handles
	 *
	 * @return void
	 */
	public function close()
	{
		if ($this->_mh) {
			curl_multi_close($this->_mh);
			$this->_mh = null;
		}
	}

	/**
	 * Run the sub-connections of the current cURL handle
	 *
	 * @param integer &$still_running
	 * @return integer
	 */
	public function exec(&$still_running)
	{
		return curl_multi_exec($this->_mh, $still_running);
	}

	/**
	 * Return the content of a cURL handle if CURLOPT_RETURNTRANSFER is set
	 *
	 * @return string
	 */
	public function getcontent()
	{
		return curl_multi_getcontent($this->_mh);
	}

	/**
	 * Get information about the current transfers
	 *
	 * @param integer &$msgs_in_queue = null
	 * @return array
	 */
	public function info_read(&$msgs_in_queue = null)
	{
		return curl_multi_info_read($this->_mh, $msgs_in_queue);
	}

	/**
	 * Initialize a cURL multi handle
	 *
	 * @return CurlMulti
	 */
	public function init()
	{
		$this->_mh = curl_multi_init();
		return $this;
	}

	/**
	 * Remove a multi handle from a set of cURL handles
	 *
	 * @param Curl|resource $ch
	 * @return integer
	 */
	public function remove_handle($ch)
	{
		if ($ch instanceof Curl) {
			$ch = $ch->resource();
		}
		return curl_multi_remove_handle($this->_mh, $ch);
	}

	/**
	 * Wait for activity on any curl_multi connection
	 *
	 * @param float $timeout
	 * @return integer
	 */
	public function select($timeout = 1.0)
	{
		return curl_multi_select($this->_mh, $timeout);
	}

	/**
	 * Set an option for the cURL multi handle
	 *
	 * @param integer $option
	 * @param mixed $value
	 * @return boolean
	 */
	public function setopt($option, $value)
	{
		return curl_multi_setopt($this->_mh, $option, $value);
	}

	/**
	 * Return string describing error code
	 *
	 * @param integer $errornum
	 * @return string
	 */
	public function strerror()
	{
		return curl_multi_strerror($errornum);
	}

}
