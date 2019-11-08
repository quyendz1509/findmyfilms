<?php

/**
 * @package     Findmyfilms
 * @version     0.0.1
 */

require_once('database/configs.php');
require_once('functions.php');
require_once('routes.php');

define('ROOT', dirname(dirname(__FILE__)));
define('THEME', 'buster');
define('THEME_ADMIN', 'admin');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_name('FMF');
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');

require_model('user');

$user_id = 0;
$user = [];

if (isset($_SESSION['id'])) {
    $id = trim($_SESSION['id']);
    $stmt = $db->prepare('SELECT * FROM `users` WHERE `id` = ? LIMIT 1');
    $stmt->execute([$id]);
    $_user = $stmt->fetch();
    if ($_user) {
        $user = $_user;
        $user_id = $user['id'];
    }
    $stmt = null;
    unset($_user);
}

$request_method = isset($_SERVER['REQUEST_METHOD']) ? trim($_SERVER['REQUEST_METHOD']) : '';
$per_page = 20;
$env = array(
    'title' => 'Findmyfilms',
    'keywords' => 'xem phim hay, phim ban quyen',
    'description' => 'Findmyfilms là dịch vụ xem phim bản quyền'
);

ob_start();
