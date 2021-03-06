<?php
use RedBean_Facade as R;
require_once LIB_PATH.'/Elo.php';

class Model_Fighter extends RedBean_SimpleModel
{
	public function update() {
		if (empty($this->id)) {
			$this->score = Elo::INITIAL_SCORE;
			$this->fights = 0;
			$results = array('win', 'lost', 'draw');
			foreach ($results as $result)
				$this->{$result.'s'} = 0;

			$this->is_active = 1;
			$this->created = date('Y-m-d H:i:s');
		}
	}

	public static function getRandomFightersForADuelAtLeastAsEpicAsThisMethodName() {
		$first = R::findOne('fighter', ' ORDER BY RAND() LIMIT ?', array(1));
		if (empty($first->id))
			return array();
		$second = R::findOne('fighter', ' id <> ? AND fights <= (SELECT AVG(fights) from fighter) ORDER BY RAND() LIMIT ?', array($first->id, 1));
		return array($first->id => $first, $second->id => $second);
	}

	public static function updateScores() {
		$activeFights = R::getCol("SELECT id FROM fight WHERE is_active = 1");
		$activeTrueFights = R::getCol("SELECT id FROM fight WHERE is_active = 1 and is_reset IS NULL");
		$query = '
			UPDATE fighter as ft
			SET
				ft.score = ('.Elo::INITIAL_SCORE.' + (SELECT SUM(fd.score_diff) FROM fightdetails as fd WHERE ft.id = fd.fighter_id AND fd.fight_id IN ('.implode(',', $activeFights).'))),
				ft.fights = (SELECT COUNT(*) FROM fightdetails as fd WHERE ft.id = fd.fighter_id AND fd.fight_id IN ('.implode(',', $activeTrueFights).')),
				ft.wins = (SELECT COUNT(*) FROM fightdetails as fd WHERE result = 1 AND ft.id = fd.fighter_id AND fd.fight_id IN ('.implode(',', $activeTrueFights).')),
				ft.losts = (SELECT COUNT(*) FROM fightdetails as fd WHERE result = 0 AND ft.id = fd.fighter_id AND fd.fight_id IN ('.implode(',', $activeTrueFights).')),
				ft.draws = (SELECT COUNT(*) FROM fightdetails as fd WHERE result = 0.5 AND ft.id = fd.fighter_id AND fd.fight_id IN ('.implode(',', $activeTrueFights).'))';
		R::exec($query);
		R::exec('UPDATE fighter SET score = '.Elo::INITIAL_SCORE.' WHERE score IS NULL' );
	}

	public static function top($number = 150) {
		$fighters = R::find('fighter', ' fights > 0 ORDER BY score DESC, name ASC limit '.$number);
		$i = $rank = 1;
		$prevScore = null;
		foreach ($fighters as &$fighter) {
			$rank = $prevScore === $fighter->score ? $rank : $i;
			$prevScore = $fighter->score;
			$i++;

			$fighter->rank = $rank;
		}
		return $fighters;
	}

	public static function importAll() {
		$existingFighters = R::findAll('fighter');
		$existingFighterNames = array();
		foreach ($existingFighters as $fighter) {
			$existingFighterNames[$fighter->id]= $fighter->name_;
		}

		$fightersToImport = R::findAll('import');
		foreach ($fightersToImport as $fighterToImport) {
			if (in_array($fighterToImport->name_, $existingFighterNames))
				continue;
			$fighter = R::dispense('fighter');
			foreach (array('hhId', 'name', 'name_') as $field) {
				$fighter->{$field} = $fighterToImport->{$field};
			}
			R::store($fighter);
		}
	}

	public static function details($id = null) {
		$fighter = $id && is_numeric($id) ? R::load('fighter', $id) : false;
		if ($fighter) {
			$fightdetails = $fighter->ownFightdetails;
			usort($fightdetails, function($a, $b) {
				return strcmp($a->fight->created, $b->fight->created)*-1;
			});

			$history = array();
			foreach ($fightdetails as $fightdetail) {
				$history[]= array(
					'fight' => $fightdetail->fight,
					'detail' => $fightdetail,
					'opponent' => reset($fightdetail->fight->withCondition(' fighter_id != ? ', array($fighter->id))->ownFightdetails)->fighter
				);
			}
			$fighter->history = $history;
		}
		return $fighter;
	}
}