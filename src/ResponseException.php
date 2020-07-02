<?php
namespace celmarket;

 /**
 * 02.07.2020 / v2.0.3 Alin Tanase
 * Initial version
 * Helper class for reporting exceptions with additional data
 */

 class ResponseException extends \Exception 
 {
 	private $_data = '';

 	public function __construct($message, $data) 
 	{
 		$this->_data = $data;
 		parent::__construct($message);
 	}

 	public function getData()
 	{
 		return $this->_data;
 	}
 }