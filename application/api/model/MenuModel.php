<?php
/**
 * @fileName MenuModel.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/6/2 14:56
 * @description 菜单模型
 */


namespace app\api\model;


use think\Collection;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\DbException;
use think\Model;

class MenuModel extends Model {

	protected $table = "menu";

	protected $hidden = ['create_time', 'update_time', 'pivot'];

	/**
	 * 获取菜单列表
	 * @return Collection
	 * @throws DataNotFoundException
	 * @throws ModelNotFoundException
	 * @throws DbException
	 */
	public function findAll() {
		$name = input("name");
		$where = [];
		$status = input("status");
		if ($status != "") {
			$where['status'] = $status;
		}
		$where['name'] = array("like", "%$name%");
		return $this->where($where)
			->order("sort", "asc")
			->select();
	}

	/**
	 * 新增菜单
	 *
	 */
	public function insertOne() {
		return $this->allowField(true)->save(input(""));
	}

	/**
	 * 更新菜单
	 */
	public function updateOne() {
		return $this->allowField(true)->save(input(""), [
			"id" => input("id")
		]);
	}

}
