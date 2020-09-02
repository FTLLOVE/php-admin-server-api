<?php
/**
 * @fileName DataBaseController.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/6/6 09:43
 * @description 数据库控制器
 */

namespace app\api\controller;

use app\enum\ScopeEnum;
use app\exception\CustomException;
use think\Config;
use think\Db;

class DataBaseController extends BaseController {

	/**
	 * 获取数据库所有表
	 *
	 * @return array
	 */
	public function showTables() {
		$tables = Db::query("show table status");
		return $this->ok($tables);
	}

	/**
	 * 删除表
	 * @throws CustomException
	 */
	public function deleteTable() {
		TableUtil::deleteTable();
		return $this->ok();
	}

	/**
	 * 获取数据库表详情
	 */
	public function getTableDetail() {

		$tableName = input("table_name");
		if (empty($tableName)) {
			return $this->fail(ScopeEnum::TABLE_EMPTY);
		}
		$database = Config::get('database')['database'];
		$sql = "select * from information_schema.columns where table_schema = '$database' and table_name = '$tableName'";
		return $this->ok(Db::query($sql));
	}


}
