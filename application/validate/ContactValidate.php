<?php
/**
 * @fileName ContactValidate.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/11/9 21:46
 * @description
 */


namespace app\validate;


class ContactValidate extends BaseValidate {

	protected $rule = [
		["content", "require", "内容不能为空"],
		["telephone", "require", "联系方式不能为空"],
	];
}
