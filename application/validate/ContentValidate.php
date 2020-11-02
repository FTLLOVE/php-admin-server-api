<?php
/**
 * @fileName ContentValidate.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/10/15 22:11
 * @description
 */


namespace app\validate;


class ContentValidate extends BaseValidate {

	protected $rule = [
		["category_id", "require", "分类不能为空"],
		["title", "require", "标题不能为空"],
		["en_title", "require", "外文标题不能为空"],
		["content", "require", "内容不能为空"],
		["en_content", "require", "外文内容不能为空"],
	];
}
