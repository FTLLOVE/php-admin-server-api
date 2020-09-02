<?php
/**
 * @fileName LoginValidate.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/6/1 22:57
 * @description 登录验证器
 */


namespace app\validate;


class LoginValidate extends BaseValidate {

	public $rule = [
		"username" => "require",
		"password" => "require",
//		"code" => "require"
	];

	public $message = [
		"username.require" => "用户名不能为空",
		"password.require" => "密码不能为空",
//		"code.require" => "验证码不能为空"
	];

}
