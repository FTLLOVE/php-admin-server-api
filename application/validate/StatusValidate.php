<?php

namespace app\validate;


class StatusValidate extends BaseValidate {

	protected $rule = [
		['id', 'require|number', 'ID不能为空|ID不合法'],
		['status', 'require|in:0,1', '状态不能为空|状态不合法']
	];

}
