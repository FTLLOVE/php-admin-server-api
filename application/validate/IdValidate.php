<?php


namespace app\validate;


class IdValidate extends BaseValidate {

	public $rule = [
		['id',"require|number", "id不能为空|id不合法"]
	];

}
