<?php
/**
 * @fileName ScopeEnum.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/6/1 20:35
 * @description 状态枚举
 */


namespace app\enum;


class ScopeEnum {

	const DEFAULT_PASSWORD = "123456";
	const USER_EXIST = "用户已存在";
	const USER_EMPTY = "用户不存在";
	const PASSWORD_ERROR = "密码错误";
	const LIST_EMPTY = "列表无数据";
	const ROLE_EXIST = "角色已存在";
	const ROLE_EMPTY = "角色不存在";
	const URL_EMPTY = "路径不能为空";
	const MENU_EXIST = "菜单已存在";
	const MENU_URL_EXIST = "菜单路径已存在";
	const MENU_EMPTY = "菜单不存在";
	const DEPARTMENT_NAME_EXIST = "部门名称已存在";
	const DEPARTMENT_EMPTY = "部门不存在";
	const POST_NAME_EXIST = "岗位名称已存在";
	const POST_CODE_EXIST = "岗位编码已存在";
	const POST_EMPTY = "岗位不存在";
	const TABLE_EMPTY = "表不存在";
	const AUTHORIZED_ERROR = "认证失败";
	const TOKEN_EMPTY = "token不能为空";
	const CODE_ERROR = "验证码错误";
	const MENU_NOT_EXIST = "菜单不存在";
}
