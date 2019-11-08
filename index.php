<?php

/**
 * @package     Findmyfilms
 * @version     0.0.1
 */

require_once('system/bootstrap.php');

$uri = $_SERVER['REQUEST_URI'];

foreach ($routes as $key => $value) {
	if (preg_match('#^' . $key . '$#', $uri)) {
		$uri = preg_replace('#^' . $key . '$#', $value, $uri);
		$a = explode('?', $uri, 2);
		if (!empty($a[1])) {
			$queries = explode('&', $a[1]);
			foreach ($queries as $query) {
				$part = explode('=', $query, 2);
				$_GET[$part[0]] = $part[1];
				if (!isset($_POST[$part[0]])) {
					$_REQUEST[$part[0]] = $part[1];
				}
			}
		}
		
		$id   = isset($_GET['id']) ? intval($_GET['id']) : NULL;
		$mod  = isset($_GET['mod']) ? $_GET['mod'] : '';
		$act  = isset($_GET['act']) ? $_GET['act'] : '';
		$slug = isset($_GET['slug']) ? $_GET['slug'] : '';

		require_once('modules/' . $a[0]);
		exit();
	}
}

abort(404);
