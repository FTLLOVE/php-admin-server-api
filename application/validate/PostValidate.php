<?php
/**
 * @fileName PostValidate.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/6/4 23:27
 * @description 岗位验证器
 */


namespace app\validate;


class PostValidate extends BaseValidate {

	protected $rule = [
		['id', "require|number", "id不能为空|id不合法"],
		["post_name", "require|max:30|unique:post", "岗位名称不能为空|岗位名称长度不能超过30|岗位名称已存在"],
		["post_code", "require|max:30|unique:post", "岗位编码不能为空|岗位编码长度不能超过30|岗位编码已存在"],
		["sort", "require|number", "岗位顺序不能为空|岗位顺序只能是数字"]
	];

	protected $scene = [
		'add' => ['post_name', 'post_code', 'sort'],
		'edit' => ['id', 'post_name', 'post_code', 'sort']
	];
}
