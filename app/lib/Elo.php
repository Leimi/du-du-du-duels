<?php
/* Implementation of the Elo rating system https://github.com/IsCoolEntertainment/Elo
Copyright © 2012, IsCool Entertainment

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE. */
class Elo
{
    const
        INITIAL_SCORE     = 1500,
        COEFF_THRESHOLD   = 2400,
        COEFFICIENT       = 15,
        COEFFICIENT_HIGH  = 10,
        STATUS_WIN        = 'win',
        STATUS_LOST       = 'lost',
        STATUS_DRAW       = 'draw',
        VALUE_WIN         = 1,
        VALUE_DRAW        = 0.5,
        VALUE_LOST        = 0;

    protected $status = array(
        self::STATUS_WIN  => self::VALUE_WIN,
        self::STATUS_DRAW => self::VALUE_DRAW,
        self::STATUS_LOST => self::VALUE_LOST,
    );

    /**
     * En+K(W-p(D))
     *
     * @param string $resultOfMatch
     * @param int    $playerElo
     * @param int    $versusElo
     *
     * @return int $elo  New elo
     */
    public function compute($resultOfMatch, $playerElo, $versusElo)
    {
        $delta  = $this->computeEloDifference($playerElo, $versusElo);
        $newElo = $playerElo + $this->getCoefficient($playerElo, $versusElo) * ($this->getStatusValue($resultOfMatch) - $delta);

        return round($newElo, 0, PHP_ROUND_HALF_UP);
    }

    protected function computeEloDifference($playerElo, $versusElo)
    {
        $diff = $playerElo - $versusElo;

        return 1/ ((pow(10, - $diff / 400)) + 1);
    }

    protected function getStatusValue($status)
    {
        if (!array_key_exists($status, $this->status))
        {
            throw new Exception(sprintf('The given status "%s" is invalid', $status));
        }

        return $this->status[$status];
    }

    protected function getCoefficient($elo1, $elo2)
    {
        if (($elo1 > self::COEFF_THRESHOLD) && ($elo2 > self::COEFF_THRESHOLD))
        {
            return self::COEFFICIENT_HIGH;
        }

        return self::COEFFICIENT;
    }
}

?>
