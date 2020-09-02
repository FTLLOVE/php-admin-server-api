<?php
/**
 * @fileName RoleModel.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/6/1 14:29
 * @description 角色模型
 */


namespace app\api\model;


use think\Db;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\DbException;
use think\Model;
use think\Paginator;
use think\Request;

class RoleModel extends Model {

	protected $table = "role";

	protected $hidden = ['create_time', 'update_time', 'pivot'];

	/**
	 * 新增角色
	 * @return int
	 */
	public function insertOne() {
		$this->allowField(true)->save(input(""));
		return $this->id;
	}

	/**
	 * 更新角色
	 *
	 */
	public function updateOne() {
		$this->allowField(true)->save(input(""), [
			"id" => input("id")
		]);
	}

	/**
	 * 查询角色列表
	 *
	 * @param Request $request
	 * @return Paginator
	 * @throws DbException
	 */
	public function findAll(Request $request) {

		$name = $request->param("name");
		$where = [];
		$status = input("status");
		if ($status != null) {
			$where['status'] = $status;
		}
		$where['name'] = array("like", "%$name%");
		return $this->where($where)
			->order("create_time", "desc")
			->paginate(input("size"), false, ['page' => input("page")]);
	}

	/**
	 * 获取角色详情
	 * @return Model
	 * @throws DbException
	 * @throws DataNotFoundException
	 * @throws ModelNotFoundException
	 */
	public function findOne() {
		$id = input("id");
		return self::with(['menu'])
			->find($id);
	}

	/**
	 * 根据角色获取菜单列表
	 * @param array $roleIds
	 * @return array
	 */
	public function getMenuListByRoleList($roleIds) {
		return Db::table("role_menu rm")
			->field(['m.id', 'm.name', 'm.pid', 'm.icon', 'm.sort', 'm.url'])
			->join("role r", "rm.role_id = r.id", "left")
			->join("menu m", "rm.menu_id = m.id", "left")
			->where("rm.role_id", "in", $roleIds)
			->select();
	}

	public function menu() {
		return $this->belongsToMany("MenuModel", "role_menu", "menu_id", "role_id");
	}

}
