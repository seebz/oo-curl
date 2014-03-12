<?php


class CurlShare
{

	/**
	 * @var resource
	 */
	protected $_sh;


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
		return $this->_sh;
	}


	/**
	 * Close a cURL share handle
	 *
	 * @return void
	 */
	public function close()
	{
		if ($this->_sh) {
			curl_share_close($this->_sh);
			$this->_sh = null;
		}
	}

	/**
	 * Initialize a cURL share handle
	 *
	 * @return CurlShare
	 */
	public function init()
	{
		$this->_sh = curl_share_init();
		return $this;
	}

	/**
	 * Set an option for the cURL share handle
	 *
	 * @param integer $option
	 * @param mixed $value
	 * @return boolean
	 */
	public function setopt($option, $value)
	{
		return curl_share_setopt($this->_sh, $option, $value);
	}

}
