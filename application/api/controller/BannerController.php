<?php
/**
 * @fileName BannerController.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/10/16 11:10
 * @description 轮播控制器
 */


namespace app\api\controller;


use app\api\model\BannerModel;
use app\exception\CustomException;
use app\validate\BannerValidate;
use app\validate\IdValidate;
use app\validate\StatusValidate;
use think\exception\DbException;

class BannerController extends BaseController {

	/**
	 * 新增Banner
	 * @return array
	 * @throws CustomException
	 */
	public function addBanner() {

		(new BannerValidate())->goCheck();

		$model = new BannerModel();
		$model->allowField(true)->save(input(""));
		return $this->ok();
	}

	/**
	 * 更新Banner
	 * @return array
	 * @throws CustomException
	 */
	public function updateBanner() {

		(new IdValidate())->goCheck();

		(new BannerValidate())->goCheck();

		$model = new BannerModel();

		$model->allowField(true)->save(input(""), [
			"id" => input("id")
		]);
		return $this->ok();
	}

	/**
	 * 更新banner状态
	 * @return array
	 * @throws CustomException
	 */
	public function updateBannerStatus() {

		(new StatusValidate())->goCheck();

		$model = new BannerModel();

		$model->save([
			"status" => input("status")
		], [
			"id" => input("id")
		]);

		return $this->ok();
	}

	/**
	 * 删除banner
	 * @return array
	 * @throws CustomException
	 */
	public function deleteBanner() {

		(new IdValidate())->goCheck();

		$model = new BannerModel();
		$model::destroy(input("id"));

		return $this->ok();
	}

	/**
	 * 获取banner详情
	 * @return array
	 * @throws CustomException
	 * @throws DbException
	 */
	public function getBannerDetail() {

		(new IdValidate())->goCheck();

		$model = new BannerModel();

		$data = $model::get(input("id"));

		return $this->ok($data);
	}

	/**
	 * 获取banner列表
	 * @return array
	 * @throws DbException
	 */
	public function getBannerList() {

		$model = new BannerModel();
		$data = $model->order("create_time desc")
			->paginate(input("size"), false, [
				"page" => input("page")
			]);
		return $this->ok($data);
	}
}
