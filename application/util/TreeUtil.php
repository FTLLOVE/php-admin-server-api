<?php
/**
 * @fileName TreeUtil.php
 * @author sprouts <1139556759@qq.com>
 * @date 2020/6/2 15:11
 * @description 树工具
 */


namespace app\util;


class TreeUtil {

	/**
	 * 构建树形结构
	 *
	 * @param $array
	 * @param int $pid
	 * @return array
	 */
	static function buildTree($array, $pid = 0) {
		$tree = array();
		foreach ($array as $key => $value) {
			if ($value['pid'] == $pid) {
				$value['children'] = self::buildTree($array, $value['id']);
				if (!$value['children']) {
					unset($value['children']);
				}
				$tree[] = $value;
			}
		}
		return $tree;
	}

}
