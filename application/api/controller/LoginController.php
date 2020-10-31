<?php
/**
 * @fileName LoginController.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/10/6 20:21
 * @description
 */


namespace app\api\controller;


use app\common\ResponseData;
use app\exception\CustomException;
use app\util\Token;
use app\validate\LoginValidate;
use think\Db;

class LoginController {

	public function login() {
		(new LoginValidate())->goCheck();

		$user = Db::table("user")->where("username", input("username"))->find();
		if (empty($user)) {
			throw new CustomException("用户不存在", 404);
		}
		$vertify = password_verify(input("password"), $user['password']);
		if (!$vertify) {
			throw new CustomException("密码错误", 403);
		}
		$token = Token::createToken($user['id']);
		return ResponseData::Success($token);

	}
}
