<?php
/**
 * @fileName QiniuUtil.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/9/25 14:51
 * @description
 */


namespace app\util;


use app\enum\ScopeEnum;
use app\exception\CustomException;
use Qiniu\Auth;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;

class QiniuUtil {

	/**
	 * 上传图片
	 *
	 * @return string 图片的url
	 * @throws CustomException
	 */
	public static function uploadImage() {
		if (empty($_FILES['file']['tmp_name'])) {
			throw new CustomException("图片上传失败");
		}
		$file = $_FILES['file']['tmp_name'];
		$pathInfo = pathinfo($_FILES['file']['name']);
		$ext = $pathInfo['extension'];
		$accesskey = config("qiniu.accesskey");
		$secretkey = config("qiniu.secretkey");
		$auth = new Auth($accesskey,$secretkey);
		$bucket = config("qiniu.bucket");
		$token = $auth->uploadToken($bucket);

		$fileName = date('Y') . '/' . date('m') . '/' .
			substr(md5($file), 8, 5) . date('Ynd') . rand(0, 9999) . '.' . $ext;

		$uploadMgr = new UploadManager();

		list($res, $err) = $uploadMgr->putFile($token, $fileName, $file);

		if ($err != null) {
			throw new CustomException("图片上传失败");
		} else {
			return $fileName;
		}
	}

	/**
	 * 删除图片
	 * @param $originFile 原图片
	 * @return bool
	 * @throws CustomException
	 */
	public static function deleteImage($originFile) {
		$isImage = preg_match('/.*(\.png|\.jpg|\.jpeg|\.gif)$/', $originFile);
		if (!$isImage) {
			throw new CustomException(ScopeEnum::IMAGE_ERROR);
		}
		$auth = new Auth(config('qiniu.accesskey'), config('qiniu.secretkey'));
		$bucketManager = new BucketManager($auth);

		$res = $bucketManager->delete(config("qiniu.bucket"), $originFile);

		if (is_null($res)) {
			return true;
		}
		return false;
	}
}
