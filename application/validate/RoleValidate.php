<?php
/**
 * @fileName RoleValidate.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/6/2 13:26
 * @description 角色管理
 */


namespace app\validate;


class RoleValidate extends BaseValidate {

	protected $rule = [
		['id', "require|number", "id不能为空|id不合法"],
		["name", "require|unique:role", "角色名称不能为空|角色名称已存在"],
		["status", "require|in:0,1", "状态不能为空|状态只能为0或1"]

	];

	protected $scene = [
		'add' => ['name', 'status'],
		'edit' => ['id', 'name', 'status']
	];
}
