<?php
/**
 * @fileName ContentValidate.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/10/15 22:11
 * @description
 */


namespace app\validate;


class TechnologyValidate extends BaseValidate {

	protected $rule = [
		["title", "require|unique:IntroductionCategory", "标题不能为空|标题不能重复"],
		["en_title", "require|unique:IntroductionCategory", "外文标题不能为空|外文标题不能重复"],
		["content", "require|unique:IntroductionCategory", "内容不能为空|内容不能重复"],
		["en_content", "require|unique:IntroductionCategory", "外文内容不能为空|外文内容不能重复"],
	];
}
