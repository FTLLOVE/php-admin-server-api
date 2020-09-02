<?php
/**
 * @fileName StatusValidate.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/6/1 17:02
 * @description 状态验证器
 */


namespace app\validate;


class StatusValidate extends BaseValidate {

	protected $rule = [
		'status' => "require|in:0,1"
	];

	protected $message = [
		"status.require" => "状态不能为空",
		"status.in" => "状态只能是0或1"
	];

}
