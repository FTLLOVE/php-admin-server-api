<?php
/**
 * @fileName GlobalExceptionHandle.php
 * @author sprouts
 * @date 2020/5/19 22:04
 * @description 全局异常捕获
 */


namespace app\exception;


use Exception;
use think\exception\ErrorException;
use think\exception\Handle;
use think\exception\HttpException;
use think\exception\PDOException;
use think\Log;

class GlobalExceptionHandle extends Handle {

	public function render(Exception $e) {
		if ($e instanceof CustomException) {
			$result = [
				"code" => 400,
				"message" => "请求错误",
				"data" => $e->data
			];
		} else if ($e instanceof HttpException) {
			$result = [
				"code" => 400,
				"message" => "请求错误",
				"data" => ""
			];
		} else if ($e instanceof ErrorException) {
			$result = [
				"code" => 500,
				"message" => "返回异常",
				"data" => ""
			];
		} else if ($e instanceof PDOException) {
			$result = [
				"code" => 600,
				"message" => "SQL异常",
				"data" => ""
			];
		} else {
			$result = [
				"code" => 50000,
				"message" => "server error",
				"data" => ""
			];
		}
		$this->handleLogger($e);
		return json($result);
	}

	/**
	 * 自定义日子记录
	 *
	 * @param Exception $exception
	 */
	private function handleLogger(Exception $exception) {
		Log::init([
			"type" => "file",
			"path" => LOG_PATH,
			"level" => ["error"]
		]);
		Log::error($exception->getMessage());
	}


}