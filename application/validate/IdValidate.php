<?php
/**
 * @fileName IdValidate.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/6/1 16:56
 * @description id验证器
 */


namespace app\validate;


class IdValidate extends BaseValidate {

	public $rule = [
		['id',"require|number", "id不能为空|id不合法"]
	];

}