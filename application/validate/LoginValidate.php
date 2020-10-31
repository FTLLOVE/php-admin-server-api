<?php
/**
 * @fileName LoginValidate.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/10/6 20:24
 * @description
 */


namespace app\validate;


class LoginValidate extends BaseValidate {

	public $rule = [
		["username", "require", "用户名不能为空"],
		["password", "require", "密码不能为空"],
	];
}
