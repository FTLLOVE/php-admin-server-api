<?php
/**
 * @fileName ResponseData.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/6/1 13:59
 * @description 公共响应
 */


namespace app\common;


class ResponseData {

	public static function Success($data = '') {
		return [
			"code" => 200,
			"message" => "成功",
			"data" => $data
		];
	}
}
