<?php
use RedBean_Facade as R;
class Model_Fight extends RedBean_SimpleModel
{
	protected static $results = array(
		'lost' => 'win',
		'win' => 'lost',
		'draw' => 'draw'
	);

	public static function add($playerId = null, $opponentId = null, $result = '') {
		if (!is_numeric($playerId) || is_numeric($opponentId) || !in_array($result, self::$results))
			return false;

		$player = R::load('fighter', $playerId);
		$opponent = R::load('fighter', $opponentId);

		if (empty($player) || empty($opponent))
			return false;

		$elo = new Elo();
		$playerScore = !empty($player->score) ? $player->score : Elo::INITIAL_SCORE;
		$opponentScore = !empty($opponent->score) ? $opponent->score : Elo::INITIAL_SCORE;

		$newPlayerScore = $elo->compute($result, $playerScore, $opponentScore);
		$newOpponentScore = $elo->compute(self::$results[$result], $opponentScore, $playerScore);
	}
}