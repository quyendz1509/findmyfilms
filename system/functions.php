<?php

/**
 * @package     Findmyfilms
 * @version     0.0.1
 */

function _e($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function redirect($url)
{
    header('location: ' . $url);
    exit();
}

function require_model($model)
{
    require_once(ROOT . '/system/database/models/' . $model . '.php');
}

function str_slug($str){
    $str = mb_strtolower($str);
	$str = html_entity_decode(trim($str), ENT_QUOTES, 'UTF-8');
	$str = str_replace(" - ", " ",$str);
    $str = html_entity_decode(trim($str), ENT_QUOTES, 'UTF-8');
	$str = str_replace(" ","-", $str);$str = str_replace("--","-", $str);
	$str = str_replace("@","-",$str);$str = str_replace("/","-",$str);
	$str = str_replace("\\","-",$str);$str = str_replace(":","",$str);
	$str = str_replace("\"","",$str);$str = str_replace("'","",$str);
	$str = str_replace("<","",$str);$str = str_replace(">","",$str);
	$str = str_replace(",","",$str);$str = str_replace("?","",$str);
	$str = str_replace(";","",$str);$str = str_replace(".","",$str);
	$str = str_replace("[","",$str);$str = str_replace("]","",$str);
	$str = str_replace("(","",$str);$str = str_replace(")","",$str);
	$str = str_replace("´","", $str);
	$str = str_replace("`","", $str);
	$str = str_replace("~","", $str);
	$str = str_replace("?","", $str);
	$str = str_replace("?","", $str);
	$str = str_replace("*","",$str);$str = str_replace("!","",$str);
	$str = str_replace("$","-",$str);$str = str_replace("&","-and-",$str);
	$str = str_replace("%","",$str);$str = str_replace("#","",$str);
	$str = str_replace("^","",$str);$str = str_replace("=","",$str);
	$str = str_replace("+","",$str);$str = str_replace("~","",$str);
	$str = str_replace("`","",$str);$str = str_replace("--","-",$str);
	$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
	$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
	$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
	$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
	$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
	$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
	$str = preg_replace("/(đ)/", 'd', $str);
	$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
	$str = str_replace(",", "", str_replace("&*#39;","",$str));
	return $str;
}

function is_email($str) {
    return (preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@gmail\.com$/ix", $str)) ? true : false;
}

function get_page($total, $return = 0)
{
    global $per_page;
    $page = isset($_GET['page']) ? abs(intval($_GET['page'])) : 1;
    if ($page < 1) {
        $page = 1;
    }
    $max_page = ceil($total / $per_page);
    if ($page > $max_page) {
        $page = $max_page;
    }
    if ($return) {
        return $page;
    }
    return ' LIMIT ' . $per_page . ' OFFSET ' . (($page - 1) * $per_page);
}

function pagination($link, $total)
{
    global $per_page;
    if ($total <= $per_page) {
        return false;
    }

    $max_page = ceil($total / $per_page);
    $current_page = get_page($total, 1);
    $return = '';
    if ($current_page > 1) {
        $return .= '<li><a href="' . $link . '/page/' . ($current_page - 1) . '">Trang trước</a></li>';
    } else {
        $return .= '<li class="previous disabled"><a href="#">Trang trước</a></li>';
    }

    if ($current_page < $max_page) {
        $return .= '<li><a href="' . $link . '/page/' . ($current_page + 1) . '">Trang sau</a></li>';
    } else {
        $return .= '<li><a href="#">Trang sau</a></li>';
    }

    return '<nav><ul>' . $return . '</ul></nav>';
}

function abort($code)
{
    require_once(ROOT . '/assets/errors/' . $code . '.html');
    exit();
}
