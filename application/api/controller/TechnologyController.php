<?php
/**
 * @fileName NewsController.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/10/15 21:25
 * @description 技术文章管理
 */


namespace app\api\controller;


use app\api\model\NewsductionModel;
use app\api\model\TechnologyModel;
use app\enum\ScopeEnum;
use app\exception\CustomException;
use app\validate\ContentValidate;
use app\validate\IdValidate;
use app\validate\StatusValidate;
use app\validate\TechnologyValidate;
use think\Db;
use think\exception\DbException;

class TechnologyController extends BaseController {

	/**
	 * 新增技术文章
	 * @return array
	 * @throws CustomException
	 */
	public function addTechnology() {

		(new TechnologyValidate())->goCheck();

		Db::transaction(function () {
			$model = new TechnologyModel();
			$model->allowField(true)->save(input(""));
		});
		return $this->ok();
	}

	/**
	 * 更新技术文章
	 * @return array
	 * @throws CustomException|DbException
	 */
	public function updateTechnology() {
		(new IdValidate())->goCheck();

		(new TechnologyValidate())->goCheck();

		$model = new TechnologyModel();

		$data = $model::get(input("id"));

		if (empty($data)) {
			return $this->fail("技术文章不存在");
		}

		$model->allowField(true)->save(input(""), [
			"id" => input("id")
		]);

		return $this->ok();
	}

	/**
	 * 更新技术文章状态
	 * @return array
	 * @throws CustomException|DbException
	 */
	public function updateTechnologyStatus() {

		(new StatusValidate())->goCheck();

		$model = new TechnologyModel();

		$data = $model::get(input("id"));

		if (empty($data)) {
			return $this->fail("技术文章不存在");
		}

		$model->save([
			"status" => input("status")
		], [
			"id" => input("id")
		]);

		return $this->ok();
	}

	/**
	 * 删除技术文章
	 * @return array
	 * @throws CustomException
	 */
	public function deleteTechnology() {

		(new IdValidate())->goCheck();

		$model = new TechnologyModel();

		$model::destroy(input("id"));

		return $this->ok();
	}

	/**
	 * 获取技术文章详情
	 * @return array
	 * @throws CustomException|DbException
	 */
	public function getTechnologyDetail() {

		(new IdValidate())->goCheck();

		$model = new TechnologyModel();

		$data = $model::get(input("id"));
		if (empty($data)) {
			return $this->fail(ScopeEnum::News_EMPTY);
		}

		return $this->ok($data);
	}

	/**
	 * 获取技术文章列表
	 * @return array
	 */
	public function getTechnologyList() {
		$model = new TechnologyModel();
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
