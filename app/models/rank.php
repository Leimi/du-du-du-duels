<?php
use RedBean_Facade as R;

class Model_Rank extends RedBean_SimpleModel
{

	const NEW_PLAYER_IN_TOWN = 1337;

	public function update() {
		if (empty($this->id)) {
			$this->created = date('Y-m-d H:i:s');
		}

		$arrays = array('list', 'diff');
		foreach ($arrays as $field) {
			if (!empty($this->{$field}) && is_array($this->{$field}))
				$this->{$field} = implode(',', $this->{$field});
		}
	}

	public function open() {
		$arrays = array('list', 'diff');
		foreach ($arrays as $field) {
			if (!empty($this->{$field})) {
				$this->{$field} = explode(',', $this->{$field});
				$this->{$field} = array_map('intval', $this->{$field});
			}
		}
	}

	public static function takeSnapshot($days = "7") {
		$top = Model_Fighter::top(150);
		$ids = array_values(array_map(function($fighter) { return $fighter->id; }, $top));

		$rank = R::dispense('rank');
		$rank->list = $ids;

		$previousRank = self::lastRankFromXDaysAgo($days);
		if (!empty($previousRank->id)) {
			$rank->diff = self::diff( $ids, $previousRank->list );
		}

		R::store($rank);
	}

	public static function lastRankFromXDaysAgo($days = "7") {
		if ($days === "0")
			return self::last();
		$rank = R::findOne('rank', ' DATE(created) <= DATE_SUB( CURDATE( ) , INTERVAL ' . $days . ' DAY) ORDER BY created DESC LIMIT 1');
		return empty($rank->id) ? null : $rank;
	}

	public static function last() {
		$rank = R::findOne('rank', ' ORDER BY created DESC LIMIT 1');
		return empty($rank->id) ? null : $rank;
	}

	/**
	 * generate an array showing position updates between 2 arrays of ids
	 * @param  array $now array of current fighter positions: numerical keys (positions), numerical values (fighter ids)
	 * @param  array $now array of fighter positions x time ago: numerical keys (positions), numerical values (fighter ids)
	 * @return array array of diff. numerical keys (fighter ids), numerical values (positions - positives values mean the fighter has climbed the ladder, negative means it has lost places)
	 */
	public static function diff($now, $old) {
		$diff = array();

		$nowPositions = array_flip($now);
		$oldPositions = array_flip($old);
		foreach ($now as $position => $id) {
			$diff[$id] = isset($oldPositions[$id]) ? $oldPositions[$id] - $position : self::NEW_PLAYER_IN_TOWN;
		}

		return $diff;
	}
}