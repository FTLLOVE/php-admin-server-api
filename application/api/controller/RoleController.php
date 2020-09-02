<?php
/**
 * @fileName RoleController.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/6/2 00:40
 * @description 角色控制器
 */


namespace app\api\controller;

use app\api\model\RoleMenuModel;
use app\api\model\RoleModel;
use app\enum\ScopeEnum;
use app\util\TreeUtil;
use app\validate\IdValidate;
use app\validate\RoleValidate;
use think\Db;
use think\Request;

class RoleController extends BaseController {

	/**
	 * 新增角色
	 */
	public function addRole() {

		(new RoleValidate())->scene('add')->goCheck();

		Db::transaction(function () {
			// 新增角色
			$roleModel = new RoleModel();
			$roleId = $roleModel->insertOne();

			$menuIds = input("menuIds/a");
			// 新增角色-菜单
			if (!empty($menuIds)) {
				$roleMenuModel = new RoleMenuModel();
				$roleMenuModel->insertMany($roleId, $menuIds);
			}
		});

		return $this->ok();
	}


	/**
	 * 更新角色
	 */
	public function updateRole() {

		(new RoleValidate())->scene("edit")->goCheck();

		// 判断是否存在
		$originRole = RoleModel::get(input("id"));
		if (empty($originRole)) {
			return $this->fail(ScopeEnum::ROLE_EMPTY);
		}

		Db::transaction(function () {
			$menuIds = input("menuIds/a");
			// 角色
			$roleModel = new RoleModel();
			$roleModel->updateOne();

			// 角色菜单
			if (!empty($menuIds)) {
				// 先删除
				$roleMenuModel = new RoleMenuModel();
				$roleMenuModel->where("role_id", "=", input("id"))->delete();

				// 新增角色-菜单
				$roleMenuModel->insertMany(input("id"), $menuIds);
			}
		});

		return $this->ok();
	}

	/**
	 * 获取角色列表
	 */
	public function getRoleList(Request $request) {

		$roleModel = new RoleModel();
		$data = $roleModel->findAll($request);

		if (empty($data->items())) {
			return $this->fail(ScopeEnum::LIST_EMPTY);
		}

		return $this->ok($data);
	}

	/**
	 * 获取角色详情
	 */
	public function getRoleDetail() {

		(new IdValidate())->goCheck();
		$roleModel = new RoleModel();
		$role = $roleModel->findOne();
		if (empty($role)) {
			return $this->fail(ScopeEnum::ROLE_EMPTY);
		}
		// 构建树
		$data = TreeUtil::buildTree($role->menu, 0);
		unset($role->menu);
		$role->menu = $data;

		return $this->ok($role);
	}

}
