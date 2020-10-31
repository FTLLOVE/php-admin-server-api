<?php

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
			if ($value['parent_id'] == $pid) {
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
