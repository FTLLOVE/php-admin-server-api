<?php
/**
 * @fileName LogModel.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/9/1 17:48
 * @description 日历
 */

namespace app\api\model;


use think\Model;
use think\Paginator;

class LogModel extends Model {
	protected $table = "log";

	/**
	 * 获取日历列表
	 * @return Paginator
	 */
	public function findAll() {
		return $this->order("create_time desc")->paginate(input("size"), false, ["page" => input("page"),]);
	}

	/**
	 * 新增日志
	 * @param $ip
	 * @param $location
	 * @return void
	 */
	public function inserOne($ip, $location) {
		$this->allowField(true)->save([
			"ip" => $ip,
			"location" => $location
		]);
	}

}
