<?php
/**
 * @fileName BannerValidate.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/10/16 11:12
 * @description
 */


namespace app\validate;


class BannerValidate extends BaseValidate {

	protected $rule = [
		["img_url", "require", "图片不能为空"],
		["en_img_url", "require", "外文图片不能为空"],
	];
}
