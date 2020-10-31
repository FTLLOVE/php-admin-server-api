<?php

namespace app\validate;


use app\exception\CustomException;
use think\Validate;

class BaseValidate extends Validate {

	/**
	 * 验证器捕获
	 * @return bool
	 * @throws CustomException
	 */
	public function goCheck() {
		$params = input("");

		// 不采用批量更新的方式
		$result = $this->check($params);

		if (!$result) {
			throw new CustomException($this->error);
		} else {
			return true;
		}
	}
}
