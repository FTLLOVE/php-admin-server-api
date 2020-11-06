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
use app\api\model\IntroductionModel;
use app\api\model\NewsCategoryModel;
use app\api\model\NewsModel;
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
		$newsCategoryModel = new NewsCategoryModel();
		$newsList = $newsCategoryModel->where("parent_id", "1")->select();
		$newsList->hidden(['status', 'create_time', 'update_time', 'parent_id']);
		$data['banner'] = $bannerData;
		$data['bottomBanner'] = $bottomBanner;
		$data['topCategoryList'] = $topCategoryList;
		$data['newsList'] = $newsList;
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
	 * TODO 获取产品列表
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
	 * 解决方案列表
	 * @return \think\Paginator
	 */
	public function getProgrammeList() {
		$programmeModel = new ProgrammeModel();
		$data = $programmeModel->findAll();
		$data->hidden(['status', 'update_time']);
		return $data;
	}


	/**
	 * 解决方案详情
	 * @return ProgrammeModel|null
	 */
	public function getProgrammeDetail() {
		$model = new ProgrammeModel();
		$data = $model::get(input("id"));
		$data->hidden(['status']);
		return $data;
	}

	/**
	 * 新闻中心列表
	 * @return \think\Paginator
	 */
	public function getNewsList() {
		$newsModel = new NewsModel();
		$data = $newsModel
			->with(['category'])
			->where("status", "1")
			->where("category_id", input("id"))
			->order("create_time desc")
			->paginate(input("size"), false, [
				"page" => input("page")
			]);
		$data->hidden(['status', 'update_time']);
		return $data;
	}

	/**
	 * 获取新闻分类列表
	 */
	public function getNewsCategoryList() {
		$model = new NewsCategoryModel();
		$data = $model->where("parent_id", "1")->select();
		return $data;
	}


	/**
	 * 新闻中心详情
	 */
	public function getNewsDetail() {
		$model = new NewsModel();
		$data = $model::get(input("id"));
		$data->hidden(['status']);
		return $data;
	}


	/**
	 * 技术文章列表
	 * @return \think\Paginator
	 */
	public function getTechnologyList() {
		$technologyModel = new TechnologyModel();
		$data = $technologyModel
			->where("status", "1")
			->order("create_time desc")
			->paginate(input("size"), false, [
				"page" => input("page")
			]);
		return $data;
	}

	/**
	 * 技术文章列表
	 * @return \think\Paginator
	 */
	public function getTechnologyDetail() {
		$technologyModel = new TechnologyModel();
		$data = $technologyModel::get(input("id"));
		$data->hidden(['update_time']);
		return $data;
	}

	public function getIntroDetail() {
		$model = new IntroductionModel();

		$data = $model::get([
			"category_id" => input("id")
		]);
		if (empty($data)) {
			return [];
		} else {
			return $data;
		}
	}
}
