<?php
/**
 * @fileName SupportController.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/10/20 21:04
 * @description 资源控制台
 */


namespace app\api\controller;


use app\exception\CustomException;
use app\util\QiniuUtil;
use think\Request;

class SupportController extends BaseController {

	/**
	 * 上传图片
	 * @param Request $request
	 * @return array
	 */
	public function uploadImage(Request $request) {
		$file = $request->file("file");
		$pathImg = "";
		//移动文件到框架应用更目录的public/uploads/
		$info = $file->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'img' . DS . date('Y') . DS . date('m-d'), md5(microtime(true)));
		if ($info) {
			$pathImg = "/static/img/" . date('Y') . '/' . date('m-d') . '/' . $info->getFilename();
		}
		$str = 'http://localhost:8888' .$pathImg;
		return $this->ok($str);
	}

	/**
	 * 删除图片
	 * @throws CustomException
	 */
	public function deleteImage() {
		$imageUrl = input("imageUrl");
		$bool = QiniuUtil::deleteImage($imageUrl);
		if ($bool) {
			return $this->ok();
		} else {
			return $this->fail("上传失败", 500);
		}
	}

}
