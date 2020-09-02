<?php
/**
 * @fileName DepartmentValidate.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/6/4 17:32
 * @description 部门验证器
 */

namespace app\validate;


class DepartmentValidate extends BaseValidate {

	protected $rule = [
		['id', "require|number", "id不能为空|id不合法"],
		["department_name", "require|max:30|unique:department", "部门名称不能为空|部门名称长度不能超过30位|部门名称已存在"],
		["sort", "require|number", "排序不能为空|排序只能是数字"]
	];

	protected $scene = [
		'add' => ['department_name', 'sort'],
		'eidt' => ['id', 'department_name', 'sort'],
	];
}
