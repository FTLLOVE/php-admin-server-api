<?php
/**
 * @fileName ProductController.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/9/25 14:07
 * @description 产品管理
 */


namespace app\api\controller;


use app\api\model\ProductCategoryModel;
use app\api\model\ProductModel;
use app\enum\ScopeEnum;
use app\exception\CustomException;
use app\validate\IdValidate;
use app\validate\ProductShowValidate;
use app\validate\ProductValidate;
use app\validate\StatusValidate;
use think\Db;
use think\exception\DbException;

class ProductController extends BaseController {

	/**
	 * 新增产品
	 * @throws CustomException
	 */
	public function addProduct() {
		(new ProductValidate())->goCheck();

		Db::transaction(function () {
			$productModel = new ProductModel();

			// 插入产品表
			$productModel->allowField(true)->save(input(""));
			// 产品图片
			$images = input("images/a");
			foreach ($images as $v) {
				Db::table("image")->insert([
					"img_url" => $v,
					"product_id" => $productModel->id
				]);
			}

			// 插入产品-分类
			$categoryIds = input("category_id/a");
			$productCategoryModel = new ProductCategoryModel();
			foreach ($categoryIds as $v) {
				Db::table("product_category")->insert([
					"product_id" => $productModel->id,
					"category_id" => $v
				]);
			}

		});

		return $this->ok();
	}

	/**
	 * 更新产品
	 * @return array
	 * @throws CustomException
	 */
	public function updateProduct() {
		(new IdValidate())->goCheck();
		(new ProductValidate())->goCheck();

		Db::transaction(function () {
			$productModel = new ProductModel();
			$productModel->allowField(true)->save(input(""), [
				'id' => input('id')
			]);
			// 图片
			$images = input("images/a");
			foreach ($images as $v) {
				Db::table("image")->insert([
					"img_url" => $v,
					"product_id" => input("id")
				]);
			}

			// 删除产品-分类
			Db::table("product_category")->where("product_id", input("id"))->delete();

			// 插入产品-分类
			$categoryIds = input("category_id/a");
			$productCategoryModel = new ProductCategoryModel();
			foreach ($categoryIds as $v) {
				Db::table("product_category")->insert([
					"product_id" => input("id"),
					"category_id" => $v
				]);
			}
		});

		return $this->ok();
	}

	/**
	 * 删除产品
	 * @return array
	 * @throws CustomException
	 */
	public function deleteProduct() {

		(new IdValidate())->goCheck();

		$productModel = new ProductModel();

		$productModel->deleteOne();

		return $this->ok();

	}

	/**
	 * 获取产品详情
	 * @return array
	 * @throws CustomException
	 * @throws DbException
	 */
	public function getProductDetail() {

		(new IdValidate())->goCheck();

		$productModel = new ProductModel();


		$product = $productModel->findOne();
		// 更新产品的浏览量
		$productModel->save([
			'pv' => $product['pv'] + 1
		], [
			'id' => input("id")
		]);

		$product = $product->hidden(['create_time', 'update_time', 'category.create_time', 'category.update_time', 'category.pivot']);
		if (empty($product)) {
			return $this->fail(ScopeEnum::PRODUCT_EMPTY);
		}
		return $this->ok($product);
	}

	/**
	 * 获取产品列表
	 * @return array
	 * @throws DbException
	 */
	public function getProductList() {
		$productModel = new ProductModel();
		$data = $productModel->findAll();
		return $this->ok($data);
	}

	/**
	 * 更新中英文显示状态
	 * @throws CustomException
	 */
	public function updateProductIsShow() {

		(new ProductShowValidate())->goCheck();

		$productModel = new ProductModel();

		$productModel->save([
			'ch_status' => input('ch_status'),
			'en_status' => input("en_status")
		], [
			'id' => input('id')
		]);

		return $this->ok();
	}

}
