<?php
/**
 * @fileName ProductValidate.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/9/25 14:29
 * @description
 */


namespace app\validate;


class ProductValidate extends BaseValidate {

	protected $rule = [
		["category_id", "require|array", "分类不能为空|分类不合法"],
		["product_name", "require|unique:product", "产品名称不能为空|产品名称不能重复"],
		["en_product_name", "require|unique:product", "外文产品名称不能为空|外文产品名称不能重复"],
	];

}
