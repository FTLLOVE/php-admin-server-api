<?php
/**
 * @fileName ToolController.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/6/15 22:47
 * @description 自动生成模板控制层
 */


namespace app\api\controller;


use app\validate\ModelValidate;
use think\Controller;

class ToolController extends Controller {

	/**
	 * 生成模型模板
	 */
	public function createModelTemplate() {
		(new ModelValidate())->goCheck();

		return $this->fetch("tool/model_template", [
			"modelName" => input("model_name"),
		]);
	}

	/**
	 * 生成控制层模板
	 */
	public function createControllerTemplate() {

		(new ModelValidate())->goCheck();

		return $this->fetch("tool/controller_template", [
			"modelName" => input("model_name"),
		]);

	}

	/**
	 * 生成js模板
	 */
	public function createApiTemplate() {

		(new ModelValidate())->goCheck();

		return $this->fetch("tool/api_template", [
			"modelName" => input("model_name")
		]);
	}

	/**
	 * 生成vue模板
	 */
	public function createVueTemplate() {

		(new ModelValidate())->goCheck();

		return $this->fetch("tool/vue_template", [
			"modelName" => input("model_name")
		]);
	}

}
