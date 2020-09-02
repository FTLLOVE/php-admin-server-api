<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * 下划线转驼峰
 * @param $uncamelized_words
 * @param string $separator
 * @return string
 */
function camelize($uncamelized_words, $separator = '_') {
	$uncamelized_words = $separator . str_replace($separator, " ", strtolower($uncamelized_words));
	return ucfirst(ltrim(str_replace(" ", "", ucwords($uncamelized_words)), $separator));
}
