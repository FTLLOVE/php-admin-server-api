<?php
/**
 * @fileName CategoryModel.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/9/25 16:30
 * @description 产品分类model
 */


namespace app\api\model;


use think\exception\DbException;
use think\Model;
use think\Paginator;

class CategoryModel extends Model {

	protected $table = "category";

	/**
	 * 新增产品分类
	 * @return int
	 */
	public function insertOne() {
		$this->allowField(true)->save(input(""));
		return $this->id;
	}

	/**
	 * 更新产品分类
	 */
	public function updateOne() {
		$this->allowField(true)->save(input(''), [
			'id' => input('id')
		]);
	}

	/**
	 * 更新产品分类状态
	 */
	public function updateStatusOne() {

		$this->save([
			'status' => input('status'),
		], [
			'id' => input('id')
		]);
	}

	/**
	 * 删除产品分类
	 */
	public function deleteOne() {
		$this::destroy(input("id"));
	}

	/**
	 * 获取产品分类详情
	 *
	 * @return CategoryModel
	 * @throws DbException
	 */
	public function findOne() {
		$productCategory = $this::get(input('id'));
		if (empty($productCategory)) {
			return null;
		}
		return $productCategory;
	}

	/**
	 * 获取产品分类列表（分页）
	 * @return Paginator
	 * @throws DbException
	 */
	public function findAll() {
		$where = [];
		$categoryName = input("categoryName");
		$where['category_name'] = array("like", "%$categoryName%");
		$status = input("status");
		if ($status != "") {
			$where['status'] = $status;
		}
		return $this->where($where)
			->order("create_time desc")
			->paginate(input("size"), false, [
				"page" => input("page")
			]);
	}

}
