<?php
/**
 * @fileName NewsController.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/10/15 21:25
 * @description 新闻资讯管理
 */


namespace app\api\controller;


use app\api\model\NewsductionModel;
use app\api\model\NewsModel;
use app\enum\ScopeEnum;
use app\exception\CustomException;
use app\validate\ContentValidate;
use app\validate\IdValidate;
use app\validate\StatusValidate;
use think\Db;
use think\exception\DbException;

class NewsController extends BaseController {

	/**
	 * 新增新闻资讯
	 * @return array
	 * @throws CustomException
	 */
	public function addNews() {

		(new ContentValidate())->goCheck();

		Db::transaction(function () {
			$model = new NewsModel();
			$model->allowField(true)->save(input(""));
		});
		return $this->ok();
	}

	/**
	 * 更新新闻资讯
	 * @return array
	 * @throws CustomException|DbException
	 */
	public function updateNews() {
		(new IdValidate())->goCheck();

		(new ContentValidate())->goCheck();

		$model = new NewsModel();

		$data = $model::get(input("id"));

		if (empty($data)) {
			return $this->fail(ScopeEnum::News_EMPTY);
		}

		$model->allowField(true)->save(input(""), [
			"id" => input("id")
		]);

		return $this->ok();
	}

	/**
	 * 更新新闻资讯
	 * @return array
	 * @throws CustomException|DbException
	 */
	public function updateNewsStatus() {

		(new StatusValidate())->goCheck();

		$model = new NewsModel();

		$data = $model::get(input("id"));

		if (empty($data)) {
			return $this->fail(ScopeEnum::News_EMPTY);
		}

		$model->save([
			"status" => input("status")
		], [
			"id" => input("id")
		]);

		return $this->ok();
	}

	/**
	 * 删除新闻资讯
	 * @return array
	 * @throws CustomException
	 */
	public function deleteNews() {

		(new IdValidate())->goCheck();

		$model = new NewsModel();

		$model::destroy(input("id"));

		return $this->ok();
	}

	/**
	 * 获取新闻资讯详情
	 * @return array
	 * @throws CustomException
	 */
	public function getNewsDetail() {

		(new IdValidate())->goCheck();

		$model = new NewsModel();

		$data = $model::get(input("id"));
		if (empty($data)) {
			return $this->fail(ScopeEnum::News_EMPTY);
		}

		$model->save([
			'pv' => $data['pv'] + 1
		], [
			'id' => input("id")
		]);

		return $this->ok($data);
	}

	/**
	 * 获取新闻资讯列表
	 * @return array
	 */
	public function getNewsList() {
		$model = new NewsModel();
		$data = $model->findAll();
		$data = $data->hidden(['category_id', 'category.create_time', 'category.update_time', 'category.parent_id', 'category.status']);
		return $this->ok($data);
	}
}
