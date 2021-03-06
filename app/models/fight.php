<?php
require_once LIB_PATH.'/Elo.php';
use RedBean_Facade as R;

class Model_Fight extends RedBean_SimpleModel
{
	public static $results = array(
		'lost' => 'win',
		'win' => 'lost',
		'draw' => 'draw'
	);

	public static $resultsKeys = array(
		'win' => 1,
		'lost' => 0,
		'draw' => 0.5
	);

	public function update() {
		if (empty($this->id)) {
			$this->ua = $_SERVER['HTTP_USER_AGENT'];
			$this->ip = $_SERVER['REMOTE_ADDR'];
			$this->created = date('Y-m-d H:i:s');
			$this->is_active = 1;
			if (empty($this->is_reset)) {
				$this->is_reset = NULL;
			}
		}
	}

	public static function add($playerId = null, $opponentId = null, $result = '') {
		if (!is_numeric($playerId) || !is_numeric($opponentId) || !in_array($result, self::$results))
			return false;

		$player = R::load('fighter', $playerId);
		$opponent = R::load('fighter', $opponentId);

		if (empty($player->id) || empty($opponent->id))
			return false;

		$elo = new Elo();
		$playerScore = !empty($player->score) ? $player->score : Elo::INITIAL_SCORE;
		$opponentScore = !empty($opponent->score) ? $opponent->score : Elo::INITIAL_SCORE;

		$opponentResult = self::$results[$result];

		$newPlayerScore = $elo->compute($result, $playerScore, $opponentScore);
		$newOpponentScore = $elo->compute($opponentResult, $opponentScore, $playerScore);

		$fight = R::dispense('fight');
		list($playerFight, $opponentFight) = R::dispense('fightdetails', 2);

		$playerFight->score_diff = $newPlayerScore - $playerScore;
		$playerFight->result = self::$resultsKeys[$result];
		$player->fights++;
		$player->{$result.'s'}++;
		$player->score = $newPlayerScore;

		$opponentFight->score_diff = $newOpponentScore - $opponentScore;
		$opponentFight->result = self::$resultsKeys[$opponentResult];
		$opponent->fights++;
		$opponent->{$opponentResult.'s'}++;
		$opponent->score = $newOpponentScore;

		$fight->ownFightdetails = array($playerFight, $opponentFight);
		$player->ownFightdetails[] = $playerFight;
		$opponent->ownFightdetails[] = $opponentFight;

		R::begin();
		try {
			$fightId = R::store($fight);
			R::store($player);
			R::store($opponent);
			R::commit();
		} catch(Exception $e) {
			R::rollback();
		}

		return !empty($fightId);
	}

	public static function total() {
		return R::count('fight', ' is_active = 1 and is_reset IS NULL', array());
	}
}