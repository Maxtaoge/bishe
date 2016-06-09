<?php
defined('IN_PHPVOD') or exit('Access Denied');
require_once PHPVOD_ROOT . 'require/listener_interface.php';
abstract class listener implements listener_interface
{
	private $listener_id;
	
	public function __construct($param)
	{
		$this->listener_id = $param;
	}
	
	public function get_listener_config()
	{
		include PHPVOD_ROOT . 'data/cache/listener.php';
		return $_listener[$this->listener_id];
	}
}

?>