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
				$this->{$field} = json_encode($this->{$field});
		}
	}

	public function open() {
		$arrays = array('list', 'diff');
		foreach ($arrays as $field) {
			if (!empty($this->{$field})) {
				$this->{$field} = json_decode($this->{$field}, true);
			}
		}
	}

	public static function takeSnapshot($days = "7") {
		$top = Model_Fighter::top(150);

		$ranksById = array();
		foreach ($top as $id => $fighter)
			$ranksById[$id] = $fighter->rank;

		$rank = R::dispense('rank');
		$rank->list = $ranksById;

		$previousRank = self::lastRankFromXDaysAgo($days);
		if (!empty($previousRank->id)) {
			$rank->diff = self::diff( $ranksById, $previousRank->list );
			$rank->rank = $previousRank;
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
	 * @param  array $now array of current fighter positions: numerical keys (fighter ids), numerical values (positions)
	 * @param  array $now array of fighter positions x time ago: numerical keys (fighter ids), numerical values (positions)
	 * @return array array of diff. numerical keys (fighter ids), numerical values (positions - positives values mean the fighter has climbed the ladder, negative means it has lost places)
	 */
	public static function diff($now, $old) {
		$diff = array();

		foreach ($now as $id => $position) {
			$diff[$id] = isset($old[$id]) ? $old[$id] - $position : self::NEW_PLAYER_IN_TOWN;
		}

		return $diff;
	}
}