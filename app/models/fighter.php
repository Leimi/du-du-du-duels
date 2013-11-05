<?php
use RedBean_Facade as R;
require_once LIB_PATH.'/Elo.php';

class Model_Fighter extends RedBean_SimpleModel
{
	public function update() {
		if (empty($this->id)) {
			$this->created = date('Y-m-d H:i:s');
			$this->active = 1;
			$this->score = Elo::INITIAL_SCORE;
		}
	}

	public static function getRandomFightersForADuelAtLeastAsEpicAsThisMethodName() {
		$first = R::findOne('fighter', ' ORDER BY RAND()');
		if (empty($first->id))
			return array();
		$second = R::findOne('fighter', ' id <> ? AND fights < (SELECT AVG(fights) from fighter)', array($first->id));
		return array($first->id => $first, $second->id => $second);
	}

	public static function updateScores() {
		$activeFights = R::getCol("SELECT id FROM fight WHERE active = 1");
		$activeTrueFights = R::getCol("SELECT id FROM fight WHERE active = 1 and is_reset IS NULL");
		$query = '
			UPDATE fighter as ft
			SET
				ft.score = ('.Elo::INITIAL_SCORE.' + (SELECT SUM(fd.score_diff) FROM fightdetails as fd WHERE ft.id = fd.player_id AND fd.fight_id IN ('.implode(',', $activeFights).'))),
				ft.fights = (SELECT COUNT(*) FROM fightdetails as fd WHERE ft.id = fd.player_id AND fd.fight_id IN ('.implode(',', $activeTrueFights).')),
				ft.wins = (SELECT COUNT(*) FROM fightdetails as fd WHERE result = 1 AND ft.id = fd.player_id AND fd.fight_id IN ('.implode(',', $activeTrueFights).')),
				ft.losts = (SELECT COUNT(*) FROM fightdetails as fd WHERE result = 0 AND ft.id = fd.player_id AND fd.fight_id IN ('.implode(',', $activeTrueFights).')),
				ft.draws = (SELECT COUNT(*) FROM fightdetails as fd WHERE result = 0.5 AND ft.id = fd.player_id AND fd.fight_id IN ('.implode(',', $activeTrueFights).'))';
		R::exec($query);
		R::exec('UPDATE fighter SET score = '.Elo::INITIAL_SCORE.' WHERE score IS NULL' );
		die;
	}

	public static function top($number = 50) {
		return R::find('fighter', ' fights > 0 ORDER BY score DESC limit '.$number);
	}
}