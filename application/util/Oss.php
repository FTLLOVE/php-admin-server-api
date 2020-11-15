<?php
/**
 * @fileName Oss.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/11/11 21:30
 * @description
 */


namespace app\util;

//require_once APP_PATH . './../vendor/aliyuncs/oss-sdk-php/autoload.php';

use OSS\OssClient;
use think\Db;
use think\Exception;
use think\Image;

class Oss {

	public static function uploadFile($mulu, $file) {
		$resResult = Image::open($file);
		$KeyId = config('aliyun_oss.accessKeyId');
		$KeySecret = config('aliyun_oss.accessKeySecret');
		$EndPoint = config('aliyun_oss.endpoint');
		$Bucket = config('aliyun_oss.bucket');
		//实例化
		$ossClient = new OssClient($KeyId, $KeySecret, $EndPoint);
		//sha1加密 生成文件名 连接后缀
		$fileName = $mulu . '/' . sha1(date('YmdHis', time()) . uniqid()) . '.' . $resResult->type();
		//执行阿里云上传
		$result = $ossClient->uploadFile($Bucket, $fileName, $file->getInfo()['tmp_name']);
		return config("aliyun_oss.url") . '/' . $fileName;
	}

	public static function deleteFile() {
		$KeyId = config('aliyun_oss.accessKeyId');
		$KeySecret = config('aliyun_oss.accessKeySecret');
		$EndPoint = config('aliyun_oss.endpoint');
		$Bucket = config('aliyun_oss.bucket');
		//实例化
		$ossClient = new OssClient($KeyId, $KeySecret, $EndPoint);
		// 删除数据库
		$filePath = input("filePath");
		Db::table("image")->where("img_url", "like", "%$filePath%")->delete();
		$ossClient->deleteObject($Bucket, $filePath);
	}
}
