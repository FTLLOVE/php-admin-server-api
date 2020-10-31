<?php
/**
 * @fileName CategoryValidate.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/9/25 16:32
 * @description
 */


namespace app\validate;


class CategoryValidate extends BaseValidate {

	protected $rule = [
		["category_name", "require|unique:category", "分类名称不能为空|分类名称不能重复"],
		["en_category_name", "require|unique:category", "外文文分类名称不能为空|外文分类名称不能重复"],
	];

}
