<?php
/**
 * @fileName BaseController.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/6/14 22:15
 * @description 基类控制器需要权限控制的都需要继承此类
 */

namespace app\api\controller;

use app\util\Token;
use think\Controller;
use think\Request;

class BaseController extends Controller {

	public function __construct(Request $request = null) {
		parent::__construct($request);
		Token::checkAuth();
	}

	public function ok($data = '', $message = 'success', $code = 200) {
		return [
			"code" => $code,
			"message" => $message,
			"data" => $data
		];
	}

	protected function fail($message = '', $code = 400, $data = '') {
		return [
			"code" => $code,
			"message" => $message,
			"data" => $data
		];
	}

}
