<?php
/**
 * @fileName ModelValidate.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/6/16 13:23
 * @description 工具模块验证器
 */


namespace app\validate;


class ModelValidate extends BaseValidate {

	protected $rule = [
		["model_name", "require", "表名不能为空"]
	];
}
