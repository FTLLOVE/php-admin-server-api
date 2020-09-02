<?php
/**
 * @fileName LoginController.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/6/1 22:55
 * @description 登录控制器
 */


namespace app\api\controller;


use app\api\model\LogModel;
use app\api\model\UserModel;
use app\common\ResponseData;
use app\enum\ScopeEnum;
use app\exception\CustomException;
use app\util\HttpUtil;
use app\util\Token;
use app\validate\LoginValidate;
use think\captcha\Captcha;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\DbException;
use think\Request;


class LoginController {

	/**
	 * 手机号&密码登录
	 *
	 * @return array
	 * @throws CustomException
	 * @throws DataNotFoundException
	 * @throws DbException
	 * @throws ModelNotFoundException
	 */
	public function login() {

		(new LoginValidate())->goCheck();

		$originUser = new UserModel();
		$originUser = $originUser->where("telephone", "=", input("username"))->find();
		if (empty($originUser)) {
			throw new CustomException(ScopeEnum::USER_EMPTY);
		}

		$verify = password_verify(input("password"), $originUser['password']);
		if (!$verify) {
			throw new CustomException(ScopeEnum::PASSWORD_ERROR);
		}
		// 插入日志
		$ip = Request::instance()->ip();
		$key = "42676acff2b1b52b28f249ef449e9709";
		$params = [
			"key" => $key,
			"ip" => $ip,
		];
		$url = "https://restapi.amap.com/v3/ip";
		$result = HttpUtil::curl($url, $params);
		$json = json_decode($result, true);
		if ($json->status == 1) {
			$province = $json->province;
			$city = $json->city;
			$location = "";
			if (!empty($province)) {
				$location .= $province;
			}
			if (!empty($city)) {
				$location .= $city;
			}
			$logModel = new LogModel();
			$logModel->inserOne($ip, $location);
		}


		$token = Token::createToken($originUser['id']);
		//TODO 正式环境需要注释Redis
//		$redis = new Redis();
//		$redis->set($token, $originUser['id']);
		return ResponseData::Success($token);
	}

	/**
	 * 生成验证码
	 */
	public function captcha() {
//		$uniqid = uniqid(mt_rand(1000, 9999));
//		$src = captcha_src($uniqid);
//		return ResponseData::Success($src);
		$captcha = new Captcha();
		$captcha->length = 4;
		$captcha->codeSet = "0123456789";
		$captcha->reset = true;
		return $captcha->entry();
	}

}
