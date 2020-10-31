<?php
/**
 * @fileName IntroductionModel.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/10/15 22:09
 * @description
 */


namespace app\api\model;


use think\Model;

class IntroductionModel extends Model {

	protected $table = "introduction";

	public function findAll() {
		$where = [];

		$title = trim(input("title"));
		$where['title'] = array("like", "%$title%");
		$content = trim(input("content"));
		$where['content'] = array("like", "%$content%");
		$status = input("status");

		if ($status != "") {
			$where['status'] = $status;
		}
		return $this
			->with(['category'])
			->where($where)
			->order("create_time desc")
			->paginate(input("size"), false, [
				"page" => input("page")
			]);
	}

	public function category() {
		return $this->hasMany("IntroductionCategoryModel", "id", "category_id");
	}


}
