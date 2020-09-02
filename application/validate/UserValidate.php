<?php
/**
 * @fileName UserValidate.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/6/1 16:55
 * @description 用户验证器
 */


namespace app\validate;


class UserValidate extends BaseValidate {

	protected $rule = [
		['id', "require|number", "id不能为空|id不合法"],
		["username", "require|max:20", "用户名不能为空|用户名长度不能超过20位"],
		["department_id", "require|number", "部门不能为空|部门必须是整数"],
		["telephone", "require|isMobile|unique:user", "手机号不能为空|手机号不合法|手机号已存在"],
		["email", "require|email", "邮箱不能为空|邮箱不合法"],
		["sex", "require|in:0,1,2", "性别不能为空|性别不合法"],
		["remark", "max:255", "备注长度不能超过255位"],
		['status', "require|in:0,1", "状态不能为空|状态只能是0或1"]

	];

	protected $scene = [
		"add" => ['username', 'department_id', 'telephone', 'email', 'sex', 'remark', 'status'],
		"edit" => ['id', 'username', 'department_id', 'telephone', 'email', 'sex', 'remark', 'status']
	];

	protected function isMobile($value, $rule = '', $data = '') {
		if (preg_match('/^1[34578]{1}\d{9}$/', $value)) {
			return true;
		}
		return false;
	}

}
