<?php
/**
 * @fileName NewsController.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/10/15 21:25
 * @description 解决方案管理
 */


namespace app\api\controller;


use app\api\model\NewsductionModel;
use app\api\model\ProgrammeModel;
use app\enum\ScopeEnum;
use app\exception\CustomException;
use app\validate\ContentValidate;
use app\validate\IdValidate;
use app\validate\StatusValidate;
use app\validate\ProgrammeValidate;
use app\validate\TechnologyValidate;
use think\Db;
use think\exception\DbException;

class ProgrammeController extends BaseController {

	/**
	 * 新增解决方案
	 * @return array
	 * @throws CustomException
	 */
	public function addProgramme() {

		(new TechnologyValidate())->goCheck();

		Db::transaction(function () {
			$model = new ProgrammeModel();
			$model->allowField(true)->save(input(""));
		});
		return $this->ok();
	}

	/**
	 * 更新解决方案
	 * @return array
	 * @throws CustomException|DbException
	 */
	public function updateProgramme() {
		(new IdValidate())->goCheck();

		(new TechnologyValidate())->goCheck();

		$model = new ProgrammeModel();

		$data = $model::get(input("id"));

		if (empty($data)) {
			return $this->fail("解决方案不存在");
		}

		$model->allowField(true)->save(input(""), [
			"id" => input("id")
		]);

		return $this->ok();
	}

	/**
	 * 更新解决方案状态
	 * @return array
	 * @throws CustomException|DbException
	 */
	public function updateProgrammeStatus() {

		(new StatusValidate())->goCheck();

		$model = new ProgrammeModel();

		$data = $model::get(input("id"));

		if (empty($data)) {
			return $this->fail("解决方案不存在");
		}

		$model->save([
			"status" => input("status")
		], [
			"id" => input("id")
		]);

		return $this->ok();
	}

	/**
	 * 删除解决方案
	 * @return array
	 * @throws CustomException
	 */
	public function deleteProgramme() {

		(new IdValidate())->goCheck();

		$model = new ProgrammeModel();

		$model::destroy(input("id"));

		return $this->ok();
	}

	/**
	 * 获取解决方案详情
	 * @return array
	 * @throws CustomException|DbException
	 */
	public function getProgrammeDetail() {

		(new IdValidate())->goCheck();

		$model = new ProgrammeModel();

		$data = $model::get(input("id"));
		if (empty($data)) {
			return $this->fail(ScopeEnum::News_EMPTY);
		}

		return $this->ok($data);
	}

	/**
	 * 获取解决方案列表
	 * @return array
	 */
	public function getProgrammeList() {
		$model = new ProgrammeModel();
		$data = $model->findAll();
		$data = $data->hidden(['category.create_time', 'category.update_time']);
		return $this->ok($data);
	}
}
