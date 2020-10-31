<?php

namespace app\util;


use app\common\ResponseData;
use app\enum\ScopeEnum;
use app\exception\CustomException;
use Exception;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;
use think\Request;


class Token {

	const KEY = "f6ca437eaa819582b27ae45c37ed9a46";

	/**
	 * 创建Token
	 * @param string $data
	 * @return string
	 */
	public static function createToken($data = "") {

		try {
			$time = time();
			$token = [
				'iss' => 'https://www.qihuishou.com',
				'aud' => 'https://www.qihuishou.com',
				'iat' => $time,
				'nbf' => $time,
				'data' => $data
			];
			return JWT::encode($token, self::KEY);
		} catch (ExpiredException $e) {  //签名不正确
			$returnData['status'] = "104";//101=签名不正确
			$returnData['msg'] = $e->getMessage();
			$returnData['data'] = "";//返回的数据
			return $returnData; //返回信息
		} catch (Exception $e) {  //其他错误
			$returnData['status'] = "199";//199=签名不正确
			$returnData['msg'] = $e->getMessage();
			$returnData['data'] = "";//返回的数据
			return $returnData; //返回信息
		}
	}

	/**
	 * 校验token
	 * @param $jwt
	 * @return mixed
	 */
	public static function vertifyToken($jwt) {
		try {
			$decoded = JWT::decode($jwt, self::KEY, ['HS256']);
			$arr = (array)$decoded;
			$returnData['status'] = "200";
			$returnData['msg'] = "success";
			$returnData['data'] = $arr;
			return $returnData; //返回信息
		} catch (SignatureInvalidException $e) {  //签名不正确
			$returnData['status'] = "101";//101=签名不正确
			$returnData['msg'] = $e->getMessage();
			$returnData['data'] = "";//返回的数据
			return ResponseData::Success($returnData);
		} catch (BeforeValidException $e) {  // 签名在某个时间点之后才能用
			$returnData['status'] = "102";
			$returnData['msg'] = $e->getMessage();
			$returnData['data'] = "";//返回的数据
			return ResponseData::Success($returnData);
		} catch (ExpiredException $e) {  // token过期nn
			$returnData['status'] = "103";//103=签名不正确
			$returnData['msg'] = $e->getMessage();
			$returnData['data'] = "";//返回的数据
			return ResponseData::Success($returnData);
		} catch (Exception $e) {  //其他错误
			$returnData['status'] = "199";//199=签名不正确
			$returnData['msg'] = $e->getMessage();
			$returnData['data'] = "";//返回的数据
			return ResponseData::Success($returnData);
		}
	}

	/**
	 * 校验token
	 *
	 * @return string
	 * @throws CustomException
	 */
	public static function checkAuth() {
		$request = Request::instance();
		$header = $request->header();
		if (!isset($header['token'])) {
			throw new CustomException(ScopeEnum::AUTHORIZED_ERROR, 401);
		}
		$jwt = $header['token'];
		$checkToken = self::vertifyToken($jwt);
		if (empty($checkToken)) {
			throw new CustomException(ScopeEnum::AUTHORIZED_ERROR, 401);
		}
		return $checkToken['data']['data'];

	}
}

