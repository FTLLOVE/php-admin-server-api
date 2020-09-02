<?php
/**
 * @fileName MenuValidate.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/6/3 10:18
 * @description 菜单验证器
 */


namespace app\validate;


class MenuValidate extends BaseValidate {

	public $rule = [
		['id', "require|number", "id不能为空|id不合法"],
		['name', 'require|unique:menu', '菜单名称不能为空|菜单名称已存在'],
		['status', 'require|in:0,1', "状态不能为空|状态不合法"],
		['sort', 'require|number', "排序不能为空|排序不合法"],
		['url', 'requireWith:status,1|unique:menu', "url不能为空|url已存在"]
	];

	public $scene = [
		'add' => ['name', 'status', 'sort', 'url'],
		'edit' => ['id', 'name', 'status', 'sort', 'url']
	];


}
