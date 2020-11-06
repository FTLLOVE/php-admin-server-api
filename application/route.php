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

// 管理端
Route::group("api/admin", function () {

	// 产品
	Route::group("product", function () {

		// 新增产品
		Route::post("addProduct", "api/ProductController/addProduct");

		// 更新产品
		Route::put("updateProduct", "api/ProductController/updateProduct");

		// 删除产品
		Route::delete("deleteProduct", "api/ProductController/deleteProduct");

		// 获取产品详情
		Route::get("getProductDetail", "api/ProductController/getProductDetail");

		// 获取产品列表
		Route::get("getProductList", "api/ProductController/getProductList");

		// 更新中英文显示状态
		Route::put("updateProductIsShow", "api/ProductController/updateProductIsShow");

	});

	// 产品分类
	Route::group("category", function () {

		// 新增产品分类
		Route::post("addCategory", "api/CategoryController/addCategory");

		// 更新产品分类
		Route::put("updateCategory", "api/CategoryController/updateCategory");

		// 更新产品分类状态
		Route::put("updateCategoryStatus", "api/CategoryController/updateCategoryStatus");

		// 删除产品分类
		Route::delete("deleteCategory", "api/CategoryController/deleteCategory");

		// 获取产品分类详情
		Route::get("getCategoryDetail", "api/CategoryController/getCategoryDetail");

		// 获取产品分类列表
		Route::get("getCategoryList", "api/CategoryController/getCategoryList");

		// 获取分类列表->产品
		Route::get("getCategoryListForProduct", "api/CategoryController/getCategoryListForProduct");


	});

	// 内容介绍分类
	Route::group("introductionCategory", function () {

		// 新增内容介绍分类
		Route::post("addIntroCategory", "api/IntroductionCategoryController/addIntroCategory");

		// 更新内容介绍分类
		Route::put("updateIntroCategory", "api/IntroductionCategoryController/updateIntroCategory");

		// 更新内容介绍分类状态
		Route::put("updateIntroCategoryStatus", "api/IntroductionCategoryController/updateIntroCategoryStatus");

		// 删除内容介绍分类
		Route::delete("deleteIntroCategory", "api/IntroductionCategoryController/deleteIntroCategory");

		// 获取内容介绍分类详情
		Route::get("getCategoryDetail", "api/IntroductionCategoryController/getIntroCategoryDetail");

		// 获取内容介绍分类列表
		Route::get("getIntroCategoryList", "api/IntroductionCategoryController/getIntroCategoryList");

		// 获取子节点列表
		Route::get("getChildIntroList", "api/IntroductionCategoryController/getChildIntroList");
	});


	// 内容介绍
	Route::group("introduction", function () {

		// 新增内容介绍
		Route::post("addIntro", "api/IntroductionController/addIntro");

		// 更新内容介绍
		Route::put("updateIntro", "api/IntroductionController/updateIntro");

		// 更新内容介绍状态
		Route::put("updateIntroStatus", "api/IntroductionController/updateIntroStatus");

		// 删除内容介绍
		Route::delete("deleteIntro", "api/IntroductionController/deleteIntro");

		// 获取内容介绍详情
		Route::get("getIntroDetail", "api/IntroductionController/getIntroDetail");

		// 获取内容介绍列表
		Route::get("getIntroList", "api/IntroductionController/getIntroList");

	});

	// 新闻资讯分类
	Route::group("newsCategory", function () {

		// 新增新闻资讯分类
		Route::post("addNewsCategory", "api/NewsCategoryController/addNewsCategory");

		// 更新新闻资讯分类
		Route::put("updateNewsCategory", "api/NewsCategoryController/updateNewsCategory");

		// 更新新闻资讯分类状态
		Route::put("updateNewsCategoryStatus", "api/NewsCategoryController/updateNewsCategoryStatus");

		// 删除新闻资讯分类
		Route::delete("deleteNewsCategory", "api/NewsCategoryController/deleteNewsCategory");

		// 获取新闻资讯分类
		Route::get("getNewsCategoryDetail", "api/NewsCategoryController/getNewsCategoryDetail");

		// 获取新闻资讯分类列表
		Route::get("getNewsCategoryList", "api/NewsCategoryController/getNewsCategoryList");

	});

	// 新闻资讯
	Route::group("news", function () {

		// 新增新闻资讯
		Route::post("addNews", "api/NewsController/addNews");

		// 更新新闻资讯
		Route::put("updateNews", "api/NewsController/updateNews");

		// 更新新闻资讯状态
		Route::put("updateNewsStatus", "api/NewsController/updateNewsStatus");

		// 删除新闻资讯
		Route::delete("deleteNews", "api/NewsController/deleteNews");

		// 获取新闻资讯详情
		Route::get("getNewsDetail", "api/NewsController/getNewsDetail");

		// 获取新闻资讯列表
		Route::get("getNewsList", "api/NewsController/getNewsList");

	});

	// 技术文章
	Route::group("technology", function () {

		// 新增技术文章
		Route::post("addTechnology", "api/TechnologyController/addTechnology");

		// 更新技术文章
		Route::put("updateTechnology", "api/TechnologyController/updateTechnology");

		// 更新技术文章状态
		Route::put("updateTechnologyStatus", "api/TechnologyController/updateTechnologyStatus");

		// 删除技术文章
		Route::delete("deleteTechnology", "api/TechnologyController/deleteTechnology");

		// 获取技术文章详情
		Route::get("getTechnologyDetail", "api/TechnologyController/getTechnologyDetail");

		// 获取技术文章列表
		Route::get("getTechnologyList", "api/TechnologyController/getTechnologyList");

	});


	// 解决方案
	Route::group("programme", function () {

		// 新增解决方案
		Route::post("addProgramme", "api/ProgrammeController/addProgramme");

		// 更新解决方案
		Route::put("updateProgramme", "api/ProgrammeController/updateProgramme");

		// 更新解决方案状态
		Route::put("updateProgrammeStatus", "api/ProgrammeController/updateProgrammeStatus");

		// 删除解决方案
		Route::delete("deleteProgramme", "api/ProgrammeController/deleteProgramme");

		// 获取解决方案详情
		Route::get("getProgrammeDetail", "api/ProgrammeController/getProgrammeDetail");

		// 获取解决方案列表
		Route::get("getProgrammeList", "api/ProgrammeController/getProgrammeList");

	});

	// 轮播
	Route::group("banner", function () {

		// 新增轮播
		Route::post("addBanner", "api/BannerController/addBanner");

		// 更新轮播
		Route::put("updateBanner", "api/BannerController/updateBanner");

		// 更新轮播状态
		Route::put("updateBannerStatus", "api/BannerController/updateBannerStatus");

		// 删除轮播
		Route::delete("deleteBanner", "api/BannerController/deleteBanner");

		// 获取轮播详情
		Route::get("getBannerDetail", "api/BannerController/getBannerDetail");

		// 获取轮播列表
		Route::get("getBannerList", "api/BannerController/getBannerList");

	});


	// 图片
	Route::group("support", function () {
		// 上传图片
		Route::post("uploadImage", "api/SupportController/uploadImage");

		// 删除图片
		Route::delete("deleteImage", "api/SupportController/deleteImage");
	});

	// 登录
	Route::group("login", function () {
		Route::post("login", "api/LoginController/login");
	});

});


// 门户
Route::group("api/front", function () {

	// 首页基础数据
	Route::get("getData", "api/FrontController/getData");

	// 首页新品推荐产品列表
	Route::get("getHomeProductList", "api/FrontController/getHomeProductList");

	// 获取产品详情
	Route::get("getProductDetail", "api/FrontController/getProductDetail");

	// 获取底部bottom的详情
	Route::get("getBottomBannerDetail", "api/FrontController/getBottomBannerDetail");

	// 解决方案列表
	Route::get("getProgrammeList", "api/FrontController/getProgrammeList");

	// 获取解决方案详情
	Route::get("getProgrammeDetail", "api/FrontController/getProgrammeDetail");

	// 新闻中心列表
	Route::get("getNewsList", "api/FrontController/getNewsList");

	Route::get("getNewsCategoryList", "api/FrontController/getNewsCategoryList");

	// 获取新闻中心详情
	Route::get("getNewsDetail", "api/FrontController/getNewsDetail");

	// 技术文章列表
	Route::get("getTechnologyList", "api/FrontController/getTechnologyList");

	// 获取文章详情
	Route::get("getTechnologyDetail", "api/FrontController/getTechnologyDetail");

	Route::get("getIntroDetail", "api/FrontController/getIntroDetail");

});


Route::get("json", "api/MockController/jsonToProduct");
Route::get("jsonToImage", "api/MockController/jsonToImage");
Route::get("mockProductCategory", "api/MockController/mockProductCategory");