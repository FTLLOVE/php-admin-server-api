<?php
/**
 * @fileName NewsModel.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/10/16 10:30
 * @description 新闻资讯模型
 */


namespace app\api\model;


use think\Model;

class ProgrammeModel extends Model {

	protected $table = "programme";

	public function findAll() {
		return $this
			->where("status", "1")
			->order("create_time desc")
			->paginate(input("size"), false, [
				"page" => input("page")
			]);
	}

}
