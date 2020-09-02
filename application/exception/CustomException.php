<?php

/**
 * @fileName CustomException.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/6/2 13:26
 * @description 自定义异常
 */

namespace app\exception;

use think\Exception;

class CustomException extends Exception {

	public $data;

	/**
	 * CustomException constructor.
	 * @param $data
	 */
	public function __construct($data = []) {
		$this->data = $data;
	}


}