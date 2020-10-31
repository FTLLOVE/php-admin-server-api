<?php

namespace app\exception;

use think\Exception;

class CustomException extends Exception {

	public $data;
	public $code;

	/**
	 * CustomException constructor.
	 * @param $data
	 * @param int $code
	 */
	public function __construct($data = [], $code = 0) {
		$this->data = $data;
		$this->code = $code;
	}


}