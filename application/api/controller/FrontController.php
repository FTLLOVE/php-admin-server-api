<?php
/**
 * @fileName FrontController.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/10/20 21:05
 * @description 门户控制
 */


namespace app\api\controller;


use app\api\model\BannerModel;
use app\api\model\BottomBannerModel;
use app\api\model\CategoryModel;
use app\api\model\IntroductionCategoryModel;
use app\api\model\NewsCategoryModel;
use app\api\model\ProductModel;
use app\api\model\ProgrammeModel;
use app\api\model\TechnologyModel;
use app\util\TreeUtil;
use think\Controller;
use think\Db;

class FrontController extends Controller {

	/**
	 * 门户接口
	 */
	public function getData() {
		$data = [];

		$categoryModel = new CategoryModel();
		$categoryData = $categoryModel
			->where("status", "1")
			->where("parent_id", "1")
			->select();
		$categoryData->hidden(['status', 'parent_id', 'create_time', 'update_time']);
		$bannerModel = new BannerModel();
		$bannerData = $bannerModel
			->where("status", "1")
			->select();
		$bannerData->hidden(['status', 'create_time', 'update_time']);
		$data['productCategory'] = $categoryData;
		$bottomBannerModel = new BottomBannerModel();
		$bottomBanner = $bottomBannerModel->select();
		$introductionCategoryModel = new IntroductionCategoryModel();
		$topCategoryList = $introductionCategoryModel->select();
		$topCategoryList->hidden(['create_time', 'update_time', 'status', 'parent_id']);
		$topCategoryList = TreeUtil::buildTree($topCategoryList, 0);
		$data['banner'] = $bannerData;
		$data['bottomBanner'] = $bottomBanner;
		$data['topCategoryList'] = $topCategoryList;
		return $data;
	}

	/**
	 * 首页新品推荐产品列表
	 */
	public function getHomeProductList() {
		$productModel = new ProductModel();
		$data = $productModel->getFrontHomeProductList(input("type"), input("limit"));
		$data->hidden(['status', 'desc1', 'desc2', 'desc3', 'desc4', 'create_time', 'update_time', 'is_top',
			'en_desc1', 'en_desc2', 'en_desc3', 'en_desc4', 'ch_status', 'en_status', 'pv',
			'category.status', 'category.create_time', 'category.update_time', 'category.parent_id',
			'category.pivot', 'image.product_id'
		]);
		return $data;
	}

	/**
	 * 技术文章列表
	 * @return \think\Paginator
	 */
	public function getTechnologyList() {
		$technologyModel = new TechnologyModel();
		$data = $technologyModel->findAll();
		return $data;
	}

	/**
	 * 获取产品列表
	 */
	public function getProductList() {
		$productModel = new ProductModel();

	}

	/**
	 * 获取产品详情
	 */
	public function getProductDetail() {
		$productModel = new ProductModel();
		$data = $productModel->with(['category', 'image'])->find(input("id"));
		$data->hidden(['status', 'create_time', 'update_time', 'is_top', 'ch_status', 'en_status',
			'category.status', 'category.create_time', 'category.update_time', 'category.parent_id',
			'category.pivot'
		]);
		return $data;
	}

	/**
	 * 获取底部bottom的详情
	 * @return BottomBannerModel|null
	 */
	public function getBottomBannerDetail() {
		$bottomBannerModel = new BottomBannerModel();
		$data = $bottomBannerModel::get(input("id"));
		return $data;
	}


	/**
	 * 技术文章列表
	 * @return \think\Paginator
	 */
	public function getProgrammeList() {
		$programmeModel = new ProgrammeModel();
		$data = $programmeModel->findAll();
		return $data;
	}
}
