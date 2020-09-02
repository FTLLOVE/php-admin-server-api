<?php
/**
 * @fileName PostController.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/6/4 23:35
 * @description 岗位控制器
 */


namespace app\api\controller;


use app\api\model\MenuModel;
use app\api\model\PostModel;
use app\enum\ScopeEnum;
use app\exception\CustomException;
use app\validate\IdValidate;
use app\validate\PostValidate;
use think\Request;

class PostController extends BaseController {

	/**
	 * 新增岗位
	 *
	 * @return array
	 */
	public function addPost() {

		(new PostValidate())->scene('add')->goCheck();

		$postModel = new PostModel();
		$postModel->insertOne();

		return $this->ok();
	}

	/**
	 * 更新岗位
	 *
	 * @return array
	 */
	public function updatePost() {

		(new PostValidate())->scene("edit")->goCheck();

		$postModel = new PostModel();
		$postModel->updateOne();

		return $this->ok();
	}

	/**
	 * 获取岗位详情
	 *
	 * @return array
	 */
	public function getPostDetail() {

		(new IdValidate())->goCheck();

		$post = PostModel::get(input("id"));

		if (empty($post)) {
			return $this->fail(ScopeEnum::POST_EMPTY);
		}

		return $this->ok($post);
	}

	/**
	 * 获取岗位列表
	 *
	 * @return array
	 * @throws CustomException
	 */
	public function getPostList() {

		$menuModel = new MenuModel();
		$data = $menuModel->findAll();

		if (empty($data->items())) {
			return $this->fail(ScopeEnum::POST_EMPTY);
		}

		return $this->ok($data);
	}
}
