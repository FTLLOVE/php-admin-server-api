<?php
/**
 * @fileName UserController.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/6/1 16:53
 * @description 用户控制器
 */


namespace app\api\controller;

use app\api\model\DepartmentModel;
use app\api\model\PostModel;
use app\api\model\RoleModel;
use app\api\model\UserModel;
use app\api\model\UserRoleModel;
use app\enum\ScopeEnum;
use app\exception\CustomException;
use app\util\TreeUtil;
use app\validate\IdValidate;
use app\validate\PasswordValidate;
use app\validate\UserValidate;
use think\Db;
use think\exception\DbException;

class UserController extends BaseController {

	/**
	 * 新增用户
	 *
	 * @return array
	 * @throws CustomException|DbException
	 */
	public function addUser() {

		(new UserValidate())->scene("add")->goCheck();

		// 部门
		$departmentId = input("department_id");
		$department = DepartmentModel::get($departmentId);
		if (empty($department)) {
			return $this->fail(ScopeEnum::DEPARTMENT_EMPTY);
		}

		// 岗位
		$postId = input("post_id");
		$post = PostModel::get($postId);
		if (!empty($postId) && empty($post)) {
			return $this->fail(ScopeEnum::POST_EMPTY);
		}

		Db::transaction(function () {
			// 新增用户
			$userModel = new UserModel();
			$userId = $userModel->insertOne();
			$roleIds = input("roleIds/a");
			// 分配角色
			if (!empty($roleIds)) {
				$userRoleModel = new UserRoleModel();
				$userRoleModel->insertMany($userId, $roleIds);
			}
		});
		return $this->ok();
	}

	/**
	 * 更新用户
	 *
	 * @return array
	 * @throws CustomException
	 * @throws DbException
	 */
	public function updateUser() {

		(new UserValidate())->scene("edit")->goCheck();

		$userId = input("id");
		$originUser = UserModel::get($userId);
		if (empty($originUser)) {
			return $this->fail(ScopeEnum::USER_EMPTY);
		}

		// 部门
		$departmentId = input("department_id");
		$department = DepartmentModel::get($departmentId);
		if (empty($department)) {
			return $this->fail(ScopeEnum::DEPARTMENT_EMPTY);
		}

		// 岗位
		$postId = input("post_id");
		$post = PostModel::get($postId);
		if (!empty($postId) && empty($post)) {
			return $this->fail(ScopeEnum::POST_EMPTY);
		}

		Db::transaction(function () use ($userId) {

			// 更新用户
			$userModel = new UserModel();
			$userModel->updateOneById();

			$userRole = UserRoleModel::getByUserId($userId);

			// 存在角色关联执行删除
			if (!empty($userRole)) {
				UserRoleModel::where("user_id", "=", $userId)->delete();
			}

			$roleIds = input("roleIds/a");
			// 分配角色
			if (!empty($roleIds)) {
				$userRoleModel = new UserRoleModel();
				$userRoleModel->insertMany($userId, $roleIds);
			}

		});

		return $this->ok();
	}

	/**
	 * 重置密码
	 *
	 * @return array
	 * @throws CustomException
	 * @throws DbException
	 */
	public function resetPassword() {

		(new PasswordValidate())->goCheck();

		$id = input("id");
		$originUser = UserModel::get($id);
		if (empty($originUser)) {
			return $this->fail(ScopeEnum::USER_EMPTY);
		}

		$userModel = new UserModel();
		$userModel->resetPassword();
		return $this->ok();
	}

	/**
	 * 获取用户列表
	 *
	 * @return array
	 * @throws DbException
	 */
	public function getUserList() {

		$userModel = new UserModel();
		$data = $userModel->findAll();
		$data = $data->hidden(['password', 'department.id', 'department.sort', 'department.status',
			'department.create_time', 'department.update_time', 'department_id', 'post_id']);

		if (empty($data->items())) {
			return $this->fail(ScopeEnum::LIST_EMPTY);
		}
		return $this->ok($data);
	}

	/**
	 * 获取用户详情
	 *
	 * @return array
	 */
	public function getUserDetail() {

		(new IdValidate())->goCheck();

		$userModel = new UserModel();
		$user = $userModel->findOne(input("id"))->hidden(['status', 'create_time', 'update_time']);

		if (empty($user)) {
			return $this->fail(ScopeEnum::USER_EMPTY);
		}

		// 获取角色数组
		$roleIds = array();
		foreach ($user->roles as $role) {
			$roleIds[] = $role->id;
		}

		// 获取菜单列表
		$roleModel = new RoleModel();
		$menuList = $roleModel->getMenuListByRoleList($roleIds);

		// 去重，构建树形菜单
		$newArr = array();
		foreach ($menuList as $k => $v) {
			if (!in_array($v, $newArr)) {
				$newArr[] = $v;
			}
		}
		$menuList = TreeUtil::buildTree($newArr, 0);
		$user->menus = $menuList;

		return $this->ok($user);
	}

}
