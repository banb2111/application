<?php

/**
 * [p 格式化打印数组]
 * @author   zzr QQ:836663500
 * @datetime 2016-12-05T14:57:46+0800
 * @param    [type]                   $arr [description]
 * @return   [type]                        [description]
 */
function p($arr){
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
}

/**
 * [vp 格式化打印字符]
 * @author   zzr QQ:836663500
 * @datetime 2016-12-05T14:57:49+0800
 * @param    [type]                   $arr [description]
 * @return   [type]                        [description]
 */
function vp($arr){
	echo '<pre>';
	var_dump($arr);
	echo '</pre>';
}