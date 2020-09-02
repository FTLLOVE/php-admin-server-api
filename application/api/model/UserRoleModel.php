<?php
/**
 * @fileName UserRoleModel.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/6/3 14:12
 * @description 用户-角色关联模型
 */


namespace app\api\model;


use Exception;
use think\Model;

class UserRoleModel extends Model {

	protected $table = "user_role";

	protected $autoWriteTimestamp = false;

	/**
	 * 新增用户-角色
	 *
	 * @param $userId
	 * @param $roleIds
	 * @throws Exception
	 */
	public function insertMany($userId, $roleIds) {
		$newRoleIds = array();
		foreach ($roleIds as $v) {
			array_push($newRoleIds, [
				"user_id" => $userId,
				"role_id" => $v
			]);
		}
		$this->saveAll($newRoleIds);
	}
}
