<?php
/**
 * @fileName CategoryController.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/9/25 16:31
 * @description 产品分类分类管理
 */


namespace app\api\controller;


use app\api\model\CategoryModel;
use app\api\model\ProductModel;
use app\enum\ScopeEnum;
use app\exception\CustomException;
use app\util\TreeUtil;
use app\validate\IdValidate;
use app\validate\CategoryValidate;
use app\validate\ProductValidate;
use app\validate\StatusValidate;
use think\Db;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\DbException;

class CategoryController extends BaseController {


	/**
	 * 新增产品分类
	 * @throws CustomException
	 */
	public function addCategory() {
		(new CategoryValidate())->goCheck();


		Db::transaction(function () {
			$categoryModel = new CategoryModel();

			// 插入产品分类表
			$categoryModel->insertOne();

		});

		return $this->ok();
	}

	/**
	 * 更新产品分类
	 * @return array
	 * @throws CustomException|DbException
	 */
	public function updateCategory() {
		(new IdValidate())->goCheck();
		(new CategoryValidate())->goCheck();

		$categoryModel = new CategoryModel();

		$productCategory = $categoryModel->findOne();

		if (empty($productCategory)) {
			return $this->fail(ScopeEnum::PRODUCT_CATEGORY_EMPTY);
		}

		$categoryModel->updateOne();

		return $this->ok();
	}

	/**
	 * 更新产品分类状态
	 * @return array
	 * @throws CustomException|DbException
	 */
	public function updateCategoryStatus() {

		(new StatusValidate())->goCheck();

		$categoryModel = new CategoryModel();

		$productCategory = $categoryModel->findOne();

		if (empty($productCategory)) {
			return $this->fail(ScopeEnum::PRODUCT_CATEGORY_EMPTY);
		}

		$categoryModel->updateStatusOne();

		return $this->ok();
	}

	/**
	 * 删除产品分类
	 * @return array
	 * @throws CustomException
	 */
	public function deleteCategory() {

		(new IdValidate())->goCheck();

		$categoryModel = new CategoryModel();

		$categoryModel->deleteOne();

		return $this->ok();

	}

	/**
	 * 获取产品分类详情
	 * @return array
	 * @throws CustomException
	 * @throws DbException
	 */
	public function getCategoryDetail() {

		(new IdValidate())->goCheck();

		$categoryModel = new CategoryModel();

		$productCategory = $categoryModel->findOne();
		if (empty($productCategory)) {
			return $this->fail(ScopeEnum::PRODUCT_CATEGORY_EMPTY);
		}
		return $this->ok($productCategory);
	}

	/**
	 * 获取产品分类列表
	 * @return array
	 * @throws DbException
	 */
	public function getCategoryList() {

		$categoryModel = new CategoryModel();

		$data = $categoryModel->findAll();

		return $this->ok($data);
	}

	/**
	 * 获取分类列表->产品管理
	 * @return array
	 * @throws DbException
	 * @throws DataNotFoundException
	 * @throws ModelNotFoundException
	 */
	public function getCategoryListForProduct() {
		$categoryModel = new CategoryModel();
		$data = $categoryModel->where("parent_id", 1)->select();
		$data = $data->hidden(['create_time', 'update_time', 'parent_id', 'status']);
		return $this->ok($data);
	}


}
