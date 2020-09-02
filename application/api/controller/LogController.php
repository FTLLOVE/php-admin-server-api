<?php
/**
 * @fileName LogController.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/9/1 17:53
 * @description 日志控制器
 */


namespace app\api\controller;


use app\api\model\LogModel;
use app\enum\ScopeEnum;

class LogController extends BaseController {

	/**
	 * 获取日志列表
	 * @return array|void
	 */
	public function getLogList() {
		$logModel = new LogModel();
		$data = $logModel->findAll();
		if (empty($data->items())) {
			return $this->fail(ScopeEnum::LIST_EMPTY);
		}
		return $this->success($data);
	}

}
