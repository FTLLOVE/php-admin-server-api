<?php
/**
 * @fileName SupportController.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/10/20 21:04
 * @description 资源控制台
 */


namespace app\api\controller;


use app\common\ResponseData;
use app\exception\CustomException;
use app\util\Oss;
use app\util\QiniuUtil;
use think\Db;
use think\Request;

class SupportController extends BaseController {

	/**
	 * 上传图片
	 * @param Request $request
	 * @return array
	 */
	public function uploadImage() {

		$file = request()->file('file');
		$result = Oss::uploadFile('file', $file);
		return ResponseData::Success($result);
	}

	/**
	 * 删除图片
	 * @return array
	 */
	public function deleteImage() {
		$result = Oss::deleteFile();
		return ResponseData::Success($result);
	}

}
