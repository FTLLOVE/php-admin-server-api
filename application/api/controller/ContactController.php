<?php
/**
 * @fileName NewsController.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/10/15 21:25
 * @description 联系我们管理
 */


namespace app\api\controller;


use app\api\model\ContactModel;
use app\api\model\NewsductionModel;
use think\exception\DbException;

class ContactController extends BaseController {

	/**
	 * 获取联系我们列表
	 * @return array
	 * @throws DbException
	 */
	public function getContactList() {
		$model = new ContactModel();
		$title = input("title");
		$content = input("content");
		$where['title'] = array("like", "%$title%");
		$where['content'] = array("like", "%$content%");
		$data = $model
			->where($where)
			->order("create_time desc")
			->paginate(input("size"), false, [
				"page" => input("page")
			]);
		return $this->ok($data);
	}
}
