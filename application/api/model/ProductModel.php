<?php
/**
 * @fileName ProductModel.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/9/25 14:09
 * @description 产品model
 */


namespace app\api\model;


use think\exception\DbException;
use think\Model;
use think\Paginator;

class ProductModel extends Model {

	protected $table = "product";

	/**
	 * 新增产品
	 * @return int
	 */
	public function insertOne() {
		$this->allowField(true)->save(input(""));
		return $this->id;
	}

	/**
	 * 更新产品
	 */
	public function updateOne() {
		$this->allowField(true)->save(input(''), [
			'id' => input('id')
		]);
	}

	/**
	 * 更新产品状态
	 */
	public function updateStatusOne() {
		$this->save([
			'status' => input('status'),
		], [
			'id' => input('id')
		]);
	}

	/**
	 * 删除产品
	 */
	public function deleteOne() {
		$this::destroy(input("id"));
	}

	/**
	 * 获取产品详情
	 *
	 * @return ProductModel|null
	 * @throws DbException
	 */
	public function findOne() {
		$product = $this->with(['category', 'image'])->select(input("id"));
		if (empty($product)) {
			return null;
		}
		return $product;
	}

	/**
	 * 获取产品列表（分页）
	 * @return Paginator
	 * @throws DbException
	 */
	public function findAll() {
		$where = [];

		$productName = trim(input("productName"));
		$where['product_name'] = array("like", "%$productName%");
		return $this
			->with(['category', 'image'])
			->where($where)
			->order("create_time desc")
			->paginate(input("size"), false, [
				"page" => input("page")
			]);
	}

	public function category() {
		return $this->belongsToMany("CategoryModel", "product_category", "category_id", "product_id");
	}

	public function image() {
		return $this->hasMany("ImageModel", "product_id", "id");
	}

	public function getFrontHomeProductList($type) {
		$where = [];
		// 中文
		if ($type == 0) {
			$where['ch_status'] = "1";
		} else {
			// 英文
			$where['en_status'] = "1";
		}
		$where['is_top'] = 1;
		return $this
			->where($where)
			->with(['category', 'image'])
			->order("create_time desc")
			->paginate(input("size"), false, [
				"page" => input("page")
			]);
	}

	public function getFrontProductListByCategory($type) {
		$where = [];
		if ($type == 0) {
			$where['ch_status'] = "1";
		} else {
			// 英文
			$where['en_status'] = "1";
		}
		return $this
			->with(['category', 'image'])
			->where($where)
			->order("create_time desc")
			->paginate(input("size"), false, [
				"page" => input("page")
			]);
	}

}
