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
		return R::findAll('fighter', ' ORDER BY RAND() LIMIT 2');
	}

	public static function updateScores() {
		$activeFights = R::getCol("SELECT id FROM fight WHERE active = 1");
		R::exec('UPDATE fighter as ft SET ft.score = ('.Elo::INITIAL_SCORE.' +
			(SELECT SUM(fd.score_diff) FROM fightdetails as fd WHERE ft.id = fd.player_id AND fd.fight_id IN ('.implode(',', $activeFights).'))
		)');
		R::exec('UPDATE fighter SET score = '.Elo::INITIAL_SCORE.' WHERE score IS NULL' );
	}
}