<?php
/**
 * @fileName MenuModel.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/6/2 14:41
 * @description 菜单控制器
 */


namespace app\api\controller;


use app\api\model\MenuModel;
use app\enum\ScopeEnum;
use app\exception\CustomException;
use app\util\TreeUtil;
use app\validate\IdValidate;
use app\validate\MenuValidate;
use think\Db;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\DbException;

class MenuController extends BaseController {

	/**
	 * 新增菜单
	 *
	 * @return array
	 * @throws CustomException
	 */
	public function addMenu() {

		(new MenuValidate())->scene('add')->goCheck();

		Db::transaction(function () {
			// 新增菜单
			$menuModel = new MenuModel();
			$menuModel->insertOne();
		});

		return $this->ok();
	}

	/**
	 * 更新菜单
	 * @return array
	 * @throws CustomException
	 * @throws DbException
	 */
	public function updateMenu() {

		(new MenuValidate())->scene('edit')->goCheck();

		$id = input("id");
		$menu = MenuModel::get($id);

		if (empty($menu)) {
			return $this->fail(ScopeEnum::MENU_EMPTY);
		}

		// 更新菜单
		Db::transaction(function () {
			$menuModel = new MenuModel();
			$menuModel->updateOne();
		});

		return $this->ok();
	}

	/**
	 * 获取菜单管理的树形结构
	 *
	 * @return array
	 * @throws DbException
	 * @throws DataNotFoundException
	 * @throws ModelNotFoundException
	 */
	public function getMenuList() {

		// 获取所有的菜单列表
		$menuModel = new MenuModel();
		$data = $menuModel->findAll();

		// 构建树形菜单列表
		$data = TreeUtil::buildTree($data);

		return $this->ok($data);
	}

	/**
	 * 获取菜单详情
	 */
	public function getMenuDetail() {

		(new IdValidate())->goCheck();

		$data = MenuModel::get(input("id"));

		if (empty($data)) {
			return $this->fail(ScopeEnum::MENU_NOT_EXIST);
		}

		return $this->ok($data);
	}
}
