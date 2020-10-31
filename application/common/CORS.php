<?php


namespace app\common;


class CORS {

	public function appInit() {
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: token,Origin, X-Requested-With, Content-Type, Accept");
		header('Access-Control-Allow-Methods: POST,GET,PUT,DELETE');
		header("Access-Control-Allow-Credentials: true");
		if (request()->isOptions()) {
			exit();
		}
	}

}
