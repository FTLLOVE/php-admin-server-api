<?php
/**
 * @fileName DepartmentModel.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/6/4 17:31
 * @description 部门模型
 */


namespace app\api\model;


use think\Model;

class DepartmentModel extends Model {

	protected $table = "department";


	/**
	 * 新增部门
	 *
	 * @return int
	 */
	public function insertOne() {
		$this->allowField(true)->save(input());
		return $this->id;
	}

	/**
	 * 更新部门
	 */
	public function updateOne() {
		$this->allowField(true)->save(input(""), [
				"id" => input("id")
			]
		);
	}

	/**
	 * 获取部门列表
	 */
	public function findAll() {
		$where = [];
		$status = input("status");
		if ($status != "") {
			$where["status"] = $status;
		}

		$departmentName = input("department_name");
		$where['department_name'] = array('like', "%$departmentName%");
		return $this->where($where)
			->paginate(input("size"), false, [
				"page" => input("page")
			]);
	}

}
