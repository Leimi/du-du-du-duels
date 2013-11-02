<?php
class Halp {
	public static function pageURL($page) {
		$hasPagination = isset($_GET['page']);
		if ($hasPagination)
			$url = preg_replace('/(.*page=)(\d+)(.*)/', '${1}'.$page.'$3', $_SERVER['REQUEST_URI']);
		else {
			$separator = empty($_GET) ? '?' : '&';
			$url = $_SERVER['REQUEST_URI'].$separator.'page='.$page;
		}

		return $url;
	}

	public static function pluralize($word, $count) {
		return $word . ($count > 1 ? 's' : '');
	}

	public static function fighterImg($fighter) {
		if (file_exists(WEBROOT_PATH.'/img/fighters/'.$fighter->name_.'.png'))
			return '<img src="/img/fighters/'.$fighter->name_.'.png" alt="'.$fighter->name.'" />';
		else
			return '';
	}
}