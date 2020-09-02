<?php
/**
 * @fileName DepartmentController.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/6/4 17:36
 * @description 部门控制器
 */


namespace app\api\controller;


use app\api\model\DepartmentModel;
use app\enum\ScopeEnum;
use app\exception\CustomException;
use app\validate\DepartmentValidate;
use app\validate\IdValidate;
use think\exception\DbException;

class DepartmentController extends BaseController {

	/**
	 * 新增部门
	 *
	 * @return array
	 * @throws CustomException
	 */
	public function addDepartment() {

		(new DepartmentValidate())->scene('add')->goCheck();

		// 新增部门
		$departmentModel = new DepartmentModel();
		$departmentModel->insertOne();

		return $this->ok();
	}

	/**
	 * 更新部门
	 *
	 * @return array
	 * @throws CustomException
	 * @throws DbException
	 */
	public function updateDepartment() {

		(new DepartmentValidate())->scene('edit')->goCheck();

		$id = input("id");

		$department = DepartmentModel::get($id);
		if (empty($department)) {
			return $this->fail(ScopeEnum::DEPARTMENT_EMPTY);
		}

		$departmentModel = new DepartmentModel();
		$departmentModel->updateOne();

		return $this->ok();
	}

	/**
	 * 获取部门详情
	 *
	 * @return array
	 * @throws CustomException
	 * @throws DbException
	 */
	public function getDepartmentDetail() {

		(new IdValidate())->goCheck();

		$department = DepartmentModel::get(input("id"));

		if (empty($department)) {
			return $this->fail(ScopeEnum::DEPARTMENT_EMPTY);
		}

		return $this->ok($department);
	}

	/**
	 * 获取部门列表
	 * @return array
	 */
	public function getDepartmentList() {

		$departmentModel = new DepartmentModel();
		$data = $departmentModel->findAll();

		if (empty($data->items())) {
			$this->fail(ScopeEnum::LIST_EMPTY);
		}
		return $this->ok($data);
	}
}
