<?php
/**
 * @fileName RoleMenuModel.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/6/3 10:25
 * @description 角色-菜单关联模型
 */


namespace app\api\model;


use Exception;
use think\Model;

class RoleMenuModel extends Model {

	protected $table = "role_menu";

	protected $autoWriteTimestamp = false;

	/**
	 * 新增角色-菜单
	 * @param $roleId
	 * @param $menuIds
	 * @throws Exception
	 */
	public function insertMany($roleId, $menuIds) {
		$newMenuIds = array();
		foreach ($menuIds as $menuId) {
			array_push($newMenuIds, [
				"role_id" => $roleId,
				"menu_id" => $menuId
			]);
		}
		$this->saveAll($newMenuIds);
	}
}
