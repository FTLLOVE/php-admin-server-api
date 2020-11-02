<?php
/**
 * @fileName NewsCategoryController.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/10/16 10:19
 * @description 新闻资讯分类管理
 */


namespace app\api\controller;


use app\api\model\NewsductionCategoryModel;
use app\api\model\NewsCategoryModel;
use app\enum\ScopeEnum;
use app\exception\CustomException;
use app\util\TreeUtil;
use app\validate\CategoryValidate;
use app\validate\IdValidate;
use app\validate\StatusValidate;
use think\Db;
use think\exception\DbException;

class NewsCategoryController extends BaseController {

	/**
	 * 新增新闻资讯分类
	 * @return array
	 * @throws CustomException
	 */
	public function addNewsCategory() {

		(new CategoryValidate())->goCheck();

		Db::transaction(function () {
			$model = new NewsCategoryModel();
			$model->allowField(true)->save(input(""));
		});
		return $this->ok();
	}

	/**
	 * 更新新闻资讯分类
	 * @return array
	 * @throws CustomException|DbException
	 */
	public function updateNewsCategory() {
		(new IdValidate())->goCheck();

		(new CategoryValidate())->goCheck();

		$model = new NewsCategoryModel();

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
	 * 更新新闻资讯分类内容
	 * @return array
	 * @throws CustomException|DbException
	 */
	public function updateNewsCategoryStatus() {

		(new StatusValidate())->goCheck();

		$model = new NewsCategoryModel();

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
	 * 删除新闻资讯分类
	 * @return array
	 * @throws CustomException
	 */
	public function deleteNewsCategory() {

		(new IdValidate())->goCheck();

		$model = new NewsCategoryModel();

		$model::destroy(input("id"));

		return $this->ok();
	}

	/**
	 * 获取新闻资讯分类详情
	 * @return array
	 * @throws CustomException|DbException
	 */
	public function getNewsCategoryDetail() {

		(new IdValidate())->goCheck();

		$model = new NewsCategoryModel();

		$data = $model::get(input("id"));
		if (empty($data)) {
			return $this->fail(ScopeEnum::PRODUCT_CATEGORY_EMPTY);
		}

		return $this->ok($data);
	}

	/**
	 * 获取新闻资讯分类列表
	 * @return array
	 * @throws DbException
	 */
	public function getNewsCategoryList() {

		$model = new NewsCategoryModel();
		$data = $model->order("create_time desc")
			->paginate(input("size"), false, [
				"page" => input("page")
			]);
		$data = TreeUtil::buildTree($data->items(), 1);
		return $this->ok($data);
	}
}
