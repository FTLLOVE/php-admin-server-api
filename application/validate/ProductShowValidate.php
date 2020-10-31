<?php
/**
 * @fileName ProductShowValidate.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/10/20 20:51
 * @description
 */


namespace app\validate;


class ProductShowValidate extends BaseValidate {

	protected $rule = [
		["id", "require", "ID不能为空"],
		["ch_status", "require", "中文状态不能为空"],
		["en_status", "require", "外文状态不能为空"]
	];

}
