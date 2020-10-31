<?php
/**
 * @fileName ProductCategoryModel.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/10/6 12:44
 * @description
 */


namespace app\api\model;


use think\Model;

class ProductCategoryModel extends Model {

	protected $table = "product_category";

	public function insertMany($productId, $categoryIds) {
		$newCategoryIds = array();
		foreach ($categoryIds as $v) {
			array_push($newCategoryIds, [
				"product_id" => $productId,
				"category_id" => $v
			]);
		}
		$this->saveAll($newCategoryIds);
	}

}
