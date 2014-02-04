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

	public static function fighterImgPath($fighter, $options = array()) {
		$options = array_merge(array('thumb' => false), $options);
		$filename = '/img/fighters/'.$fighter->name_.($options['thumb'] ? '_thumb' : '').'.png';
		return file_exists(WEBROOT_PATH.$filename) ? $filename : '';
	}

	public static function rankIcon($diff)	{
		$data = array();
		if ($diff === Model_Rank::NEW_PLAYER_IN_TOWN) {
			$data = array('&lowast;', 'New this week', 'rank rank--new');
		} elseif ($diff > 0) {
			$data = array('&uarr;', 'Gained '.$diff.' '.self::pluralize('place', $diff).' this week', 'rank rank--up');
		} elseif ($diff < 0) {
			$diff = $diff*-1;
			$data = array('&darr;', 'Lost '.$diff.' '.self::pluralize('place', $diff).' this week', 'rank rank--down');
		} elseif ($diff === 0) {
			$data = array('&rarr;', 'Not moved since last week', 'rank rank--still');
		}
		return '<span title="'.$data[1].'" class="'.$data[2].'">'.$data[0].'</span>';
	}
}