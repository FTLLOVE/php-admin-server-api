<?php
/**
 * @fileName PasswordValidate.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/6/1 23:12
 * @description 密码校验器
 */


namespace app\validate;


class PasswordValidate extends BaseValidate {

	public $rule = [
		['id', "require|number", "id不能为空|id不合法"],
		["password","require", "密码不能为空"]
	];

}
