<?php

namespace app\api\controller;

use app\util\Token;
use think\Controller;
use think\Request;

class BaseController extends Controller {

	public function __construct(Request $request = null) {
		parent::__construct($request);
		// 权限验证
//		Token::checkAuth();
	}

	public function ok($data = '', $message = 'success', $code = 200) {
		return [
			"code" => $code,
			"message" => $message,
			"data" => $data
		];
	}

	protected function fail($message = '', $code = 401, $data = '') {
		return [
			"code" => $code,
			"message" => $message,
			"data" => $data
		];
	}
}
