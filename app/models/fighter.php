<?php
use RedBean_Facade as R;
class Model_Fighter extends RedBean_SimpleModel
{


	public static function getFighters() {
		return R::findAll('fighter', ' ORDER BY RAND() LIMIT 2');
	}
}