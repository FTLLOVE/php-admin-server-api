<?php
/**
 * @fileName IntroductionController.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/10/15 21:23
 * @description 介绍内容管理
 */


namespace app\api\controller;


use app\api\model\IntroductionModel;
use app\enum\ScopeEnum;
use app\exception\CustomException;
use app\validate\IdValidate;
use app\validate\ContentValidate;
use app\validate\StatusValidate;
use think\Db;
use think\exception\DbException;

class IntroductionController extends BaseController {

	/**
	 * 新增介绍内容
	 * @return array
	 * @throws CustomException
	 */
	public function addIntro() {

		Db::transaction(function () {
			$data = input("");
			$model = new IntroductionModel();
			$model->allowField(true)->save(input(""));
		});
		return $this->ok();
	}

	/**
	 * 更新介绍内容
	 * @return array
	 * @throws CustomException|DbException
	 */
	public function updateIntro() {
		(new IdValidate())->goCheck();

		(new ContentValidate())->goCheck();

		$model = new IntroductionModel();

		$data = $model::get(input("id"));

		if (empty($data)) {
			return $this->fail(ScopeEnum::INTRODUCTION_EMPTY);
		}

		$model->allowField(true)->save(input(""), [
			"id" => input("id")
		]);

		return $this->ok();
	}

	/**
	 * 更新介绍内容
	 * @return array
	 * @throws CustomException|DbException
	 */
	public function updateIntroStatus() {

		(new StatusValidate())->goCheck();

		$model = new IntroductionModel();

		$data = $model::get(input("id"));

		if (empty($data)) {
			return $this->fail(ScopeEnum::INTRODUCTION_EMPTY);
		}

		$model->save([
			"status" => input("status")
		], [
			"id" => input("id")
		]);

		return $this->ok();
	}

	/**
	 * 删除介绍内容
	 * @return array
	 * @throws CustomException
	 */
	public function deleteIntro() {

		(new IdValidate())->goCheck();

		$model = new IntroductionModel();

		$model::destroy(input("id"));

		return $this->ok();
	}

	/**
	 * 获取介绍内容详情
	 * @return array
	 * @throws CustomException|DbException
	 */
	public function getIntroDetail() {

		(new IdValidate())->goCheck();

		$model = new IntroductionModel();

		$data = $model::get(input("id"));
		if (empty($data)) {
			return $this->fail(ScopeEnum::INTRODUCTION_EMPTY);
		}

		return $this->ok($data);
	}

	/**
	 * 获取介绍内容列表
	 * @return array
	 */
	public function getIntroList() {
		$model = new IntroductionModel();
		$data = $model->findAll();
		$data = $data->hidden(['category_id', 'category.create_time', 'category.update_time', 'category.parent_id', 'category.status']);
		return $this->ok($data);
	}
}
