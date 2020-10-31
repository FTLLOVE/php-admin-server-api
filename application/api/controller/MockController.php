<?php
/**
 * @fileName MockController.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/10/6 21:11
 * @description
 */


namespace app\api\controller;


use think\Db;

class MockController {

	public function jsonToProduct() {
		$fileName = '../public/static/product.json';
		$string = file_get_contents($fileName);
		$data = json_decode($string, true);
		$data = $data['data']['list'];
		$arr = [];
		for ($i = 0; $i < count($data); $i++) {
			array_push($arr, [
				"product_name" => $data[$i]['productName'],
				"status" => 1,
				"is_top" => 0,
				"pv" => $i,
			]);
		}
		Db::name("product")->insertAll($arr);
		return "ok";
	}

	public function jsonToImage() {
		$fileName = '../public/static/product.json';
		$string = file_get_contents($fileName);
		$data = json_decode($string, true);
		$data = $data['data']['list'];
		$arr = [];
		$imageUrl = [
			"https://ss3.bdstatic.com/70cFv8Sh_Q1YnxGkpoWK1HF6hhy/it/u=2784242897,2135670146&fm=26&gp=0.jpg",
			"https://ss2.bdstatic.com/70cFvnSh_Q1YnxGkpoWK1HF6hhy/it/u=3763564831,1057425173&fm=26&gp=0.jpg",
			"https://ss3.bdstatic.com/70cFv8Sh_Q1YnxGkpoWK1HF6hhy/it/u=3190850050,2037116511&fm=15&gp=0.jpg",
			"https://ss0.bdstatic.com/70cFuHSh_Q1YnxGkpoWK1HF6hhy/it/u=773415124,3684521620&fm=15&gp=0.jpg",
			"https://ss3.bdstatic.com/70cFv8Sh_Q1YnxGkpoWK1HF6hhy/it/u=184626344,2918188189&fm=26&gp=0.jpg",
			"https://ss2.bdstatic.com/70cFvnSh_Q1YnxGkpoWK1HF6hhy/it/u=368416563,3912033821&fm=15&gp=0.jpg",
			"https://ss0.bdstatic.com/70cFuHSh_Q1YnxGkpoWK1HF6hhy/it/u=4081319221,367193479&fm=15&gp=0.jpg"
		];
		for ($i = 0; $i < count($data); $i++) {
			array_push($arr, [
				"img_url" => $imageUrl[array_rand($imageUrl, 1)],
				"product_id" => $i + 1,
				"is_out_image" => 1
			]);
		}
		Db::name("image")->insertAll($arr);
		return "ok";
	}

	public function mockProductCategory() {
		$fileName = '../public/static/product.json';
		$string = file_get_contents($fileName);
		$data = json_decode($string, true);
		$data = $data['data']['list'];
		$arr = [];
		$rand_arr = [1, 2, 3, 4, 5, 6];
		for ($i = 0; $i < count($data); $i++) {
			array_push($arr, [
				"product_id" => $i + 1,
				"category_id" => $rand_arr[array_rand($rand_arr, 1)]
			]);
		}
		Db::name("product_category")->insertAll($arr);
		return "ok";
	}
}
