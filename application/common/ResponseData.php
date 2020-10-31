<?php

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
