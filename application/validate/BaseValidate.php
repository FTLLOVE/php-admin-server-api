<?php
/**
 * @fileName BaseValidate.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/6/1 16:53
 * @description 基类验证器
 */


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
