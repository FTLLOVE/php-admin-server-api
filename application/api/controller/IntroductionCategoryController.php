<?php
/**
 * @fileName IntroductionCategoryController.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/10/15 21:23
 * @description 介绍内容分类管理
 */


namespace app\api\controller;


use app\api\model\IntroductionCategoryModel;
use app\enum\ScopeEnum;
use app\exception\CustomException;
use app\util\TreeUtil;
use app\validate\CategoryValidate;
use app\validate\IdValidate;
use app\validate\StatusValidate;
use think\Db;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\DbException;

class IntroductionCategoryController extends BaseController {

	/**
	 * 新增介绍内容分类
	 * @return array
	 * @throws CustomException
	 */
	public function addIntroCategory() {

		(new CategoryValidate())->goCheck();

		Db::transaction(function () {
			$model = new IntroductionCategoryModel();
			$model->allowField(true)->save(input(""));
		});
		return $this->ok();
	}

	/**
	 * 更新介绍内容分类
	 * @return array
	 * @throws CustomException|DbException
	 */
	public function updateIntroCategory() {
		(new IdValidate())->goCheck();

		(new CategoryValidate())->goCheck();

		$model = new IntroductionCategoryModel();

		$data = $model::get(input("id"));

		if (empty($data)) {
			return $this->fail(ScopeEnum::PRODUCT_CATEGORY_EMPTY);
		}

		$model->allowField(true)->save(input(""), [
			"id" => input("id")
		]);

		return $this->ok();
	}

	/**
	 * 更新介绍内容分类内容
	 * @return array
	 * @throws CustomException|DbException
	 */
	public function updateIntroCategoryStatus() {

		(new StatusValidate())->goCheck();

		$model = new IntroductionCategoryModel();

		$data = $model::get(input("id"));

		if (empty($data)) {
			return $this->fail(ScopeEnum::PRODUCT_CATEGORY_EMPTY);
		}

		$model->save([
			"status" => input("status")
		], [
			"id" => input("id")
		]);

		return $this->ok();
	}

	/**
	 * 删除介绍内容分类
	 * @return array
	 * @throws CustomException
	 */
	public function deleteIntroCategory() {

		(new IdValidate())->goCheck();

		$model = new IntroductionCategoryModel();

		$model::destroy(input("id"));

		return $this->ok();
	}

	/**
	 * 获取介绍内容分类详情
	 * @return array
	 * @throws CustomException|DbException
	 */
	public function getIntroCategoryDetail() {

		(new IdValidate())->goCheck();

		$model = new IntroductionCategoryModel();

		$data = $model::get(input("id"));
		if (empty($data)) {
			return $this->fail(ScopeEnum::PRODUCT_CATEGORY_EMPTY);
		}

		return $this->ok($data);
	}

	/**
	 * 获取介绍内容分类列表
	 * @return array
	 * @throws DbException
	 */
	public function getIntroCategoryList() {

		$model = new IntroductionCategoryModel();
		$data = $model->order("create_time desc")
			->paginate(input("size"), false, [
				"page" => input("page")
			]);
		$data = TreeUtil::buildTree($data->items(), 0);
		return $this->ok($data);
	}

	/**
	 * 获取子节点列表
	 * @return array
	 * @throws DbException
	 * @throws DataNotFoundException
	 * @throws ModelNotFoundException
	 */
	public function getChildIntroList() {
		$model = new IntroductionCategoryModel();

		$data = $model->where("parent_id", "1")->select();
		return $this->ok($data);
	}
}
