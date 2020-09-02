<?php
/**
 * @fileName PostModel.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/6/4 23:23
 * @description 岗位模型
 */


namespace app\api\model;


use think\Model;

class PostModel extends Model {

	protected $table = "post";


	/**
	 * 新增岗位
	 */
	public function insertOne() {
		return $this->allowField(true)->save(input(""));
	}

	/**
	 * 更新岗位
	 */
	public function updateOne() {
		return $this->allowField(true)->save(input(""), [
			"id" => input("id")
		]);
	}

	/*
	 * 获取岗位列表
	 */
	public function findAll() {
		$postName = input("post_name");
		$postCode = input("post_code");
		$status = input("status");
		$where = [];
		if ($status != "") {
			$where['status'] = $status;
		}
		$where['post_name'] = array("like", "%$postName%");
		$where['post_code'] = array("like", "%$postCode%");
		return $this->where($where)
			->paginate(input("size"), false, [
				"page" => input("page")
			]);
	}

	/**
	 * 获取岗位详情
	 */
	public function getPostDetail() {
		return $this->where("id", "=", input("id"))->find();
	}

}
