<?php

namespace app\api\model;


use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\DbException;
use think\Model;
use think\Paginator;

class UserModel extends Model {

	protected $table = "user";

	protected $hidden = ['password'];

	/**
	 * 新增用户
	 * @return int
	 */
	public function insertOne() {
		$params = input("");
		$params['password'] = password_hash(input("password"), PASSWORD_BCRYPT);
		$this->allowField(true)->save($params);
		return $this->id;
	}

	/**
	 * 更新用户
	 */
	public function updateOneById() {
		$params = input("");
		// 更新用户不允许修改密码
		if (empty($params['password'])) {
			$user = $this->findOne(input("id"));
			$params['password'] = $user['password'];
		}
		$this->allowField(true)->save($params, ["id" => input("id")]);
	}


	/**
	 * 重置密码
	 */
	public function resetPassword() {
		$params = input("");
		$params['password'] = password_hash(input("password"), PASSWORD_BCRYPT);
		$this->allowField(['password'])->save($params, ['id' => input("id")]);
	}

	/**
	 * 查询用户列表
	 *
	 * @return Paginator
	 * @throws DbException
	 */
	public function findAll() {
		$username = input("username");
		$telephone = input("telephone");
		$status = input("status");
		$departmentId = input("department_id");
		$where = [];
		if ($status != "") {
			$where['status'] = $status;
		}
		if ($departmentId != "") {
			$where['department_id'] = $departmentId;
		}
		$where['username'] = array("like", "%$username%");
		$where['telephone'] = array("like", "%$telephone%");
		return $this::with(['department'])
			->where($where)
			->order("create_time", "desc")
			->paginate(input("size"), false, ['page' => input("page")]);
	}

	/**
	 * 获取用户详情
	 * @return Model
	 * @throws DbException
	 * @throws DataNotFoundException
	 * @throws ModelNotFoundException
	 */
	public function findOne($userId) {
		return $this::with(['roles'])
			->where("id", "=", $userId)
			->find();
	}

	/**
	 * 更新用户状态
	 */
	public function updateUserStatus() {
		$this->save([
			'status' => input("status")
		], ['id' => input("id"),]);
	}

	public function roles() {
		return $this->belongsToMany("RoleModel", "user_role", "role_id", "user_id");
	}

	public function department() {
		return $this->belongsTo("DepartmentModel", "department_id", "id");
	}

}
