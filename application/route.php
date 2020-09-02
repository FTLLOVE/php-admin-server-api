<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

// 验证码管理
Route::group("api/captcha", function () {

	// 生成验证码
	Route::get("captcha", "api/LoginController/captcha");

});

// 登录管理
Route::group("api/login", function () {

	// 登录
	Route::post("login", "api/LoginController/login");

});

// 用户管理
Route::group("api/user", function () {

	// 获取用户列表
	Route::get("getUserList", "api/UserController/getUserList");

	// 新增用户
	Route::post("addUser", "api/UserController/addUser");

	// 更新用户
	Route::put("updateUser", "api/UserController/updateUser");

	// 重置密码
	Route::put("resetPassword", "api/UserController/resetPassword");

	// 获取用户详情
	Route::get("getUserDetail", "api/UserController/getUserDetail");

});

// 角色管理
Route::group("api/role", function () {

	// 获取角色列表
	Route::get("getRoleList", "api/RoleController/getRoleList");

	// 新增角色
	Route::post("addRole", "api/RoleController/addRole");

	// 更新角色
	Route::put("updateRole", "api/RoleController/updateRole");

	// 获取角色详情
	Route::get("getRoleDetail", "api/RoleController/getRoleDetail");

});

// 菜单管理
Route::group("api/menu", function () {

	// 新增菜单
	Route::post("addMenu", "api/MenuController/addMenu");

	// 更新菜单
	Route::put("updateMenu", "api/MenuController/updateMenu");

	// 获取菜单列表
	Route::get("getMenuList", "api/MenuController/getMenuList");

	Route::get("getMenuDetail", "api/MenuController/getMenuDetail");

});

// 部门管理
Route::group("api/department", function () {

	// 新增部门
	Route::post("addDepartment", "api/DepartmentController/addDepartment");

	// 更新部门
	Route::put("updateDepartment", "api/DepartmentController/updateDepartment");

	// 获取部门详情
	Route::get("getDepartmentDetail", "api/DepartmentController/getDepartmentDetail");

	// 获取部门列表
	Route::get("getDepartmentList", "api/DepartmentController/getDepartmentList");
});

// 岗位管理
Route::group("api/post", function () {

	// 新增岗位
	Route::post("addPost", "api/PostController/addPost");

	// 更新岗位
	Route::put("updatePost", "api/PostController/updatePost");

	// 获取岗位详情
	Route::get("getPostDetail", "api/PostController/getPostDetail");

	// 获取岗位列表
	Route::get("getPostList", "api/PostController/getPostList");
});

// 数据库管理
Route::group("api/database", function () {

	// 获取数据库所有表
	Route::get("showTables", "api/DataBaseController/showTables");

	// 删除表
	Route::delete("deleteTable", "api/DataBaseController/deleteTable");

	// 获取数据库表详情信息
	Route::get("getTableDetail", "api/DataBaseController/getTableDetail");

});

// 自动生成模板管理
Route::group("api/tool", function () {

	// 生成模型模板
	Route::get("createModelTemplate", "api/ToolController/createModelTemplate");

	// 生成控制层模板
	Route::get("createControllerTemplate", "api/ToolController/createControllerTemplate");

	// 生成api模板
	Route::get("createApiTemplate", "api/ToolController/createApiTemplate");

	// 生成vue模板
	Route::get("createVueTemplate", "api/ToolController/createVueTemplate");
});

// 日志管理
Route::group("api/log", function () {
	// 获取日志列表
	Route::get("getLogList", "api/LogController/getLogList");

});


Route::get("index", "api/Index/index");
