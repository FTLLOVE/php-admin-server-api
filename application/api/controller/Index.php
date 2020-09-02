<?php
/**
 * @fileName Index.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/6/15 21:00
 * @description
 */


namespace app\api\controller;


use app\common\ResponseData;
use app\util\HttpUtil;
use think\Controller;

class Index extends Controller {

	public function index() {
		$params = [
			"key" => "42676acff2b1b52b28f249ef449e9709",
			"ip" => "117.136.100.245"
		];
		$data = HttpUtil::curl("https://restapi.amap.com/v3/ip", $params);
		$data = json_decode($data);
		if ($data -> status == "1") {
			$province = $data -> province;
			$city = $data -> city;
			$location = "";
			if (!empty($province)) {
				$location .= $province;
			}
			if (!empty($city)) {
				$location .= $city;
			}
			$data->location = $location;
		}
		return ResponseData::Success($data);
//		return "success";
	}

//	public function redis() {
//		$redis = new Redis();
//		$data = $redis->get("eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvd3d3LnFpaHVpc2hvdS5jb20iLCJhdWQiOiJodHRwczpcL1wvd3d3LnFpaHVpc2hvdS5jb20iLCJpYXQiOjE1OTgyNTM5NTUsIm5iZiI6MTU5ODI1Mzk1NSwiZGF0YSI6MX0.QhlhqKMNDo4-Rb6gDqLVjqwUBj9ZbTUMQpW1AIkcVbw");
//		echo $data;
//	}
}
