<?php

namespace App\Repositories;

class TacticDataRepository extends BaseRepository
{

    public function __construct(){}

    public function getTacticData($basicDataValue)
    {
        $startTime = $this->milliseconds();

        $actualMoney = $basicDataValue['startMoney'];
        $startMoney = $basicDataValue['startMoney'];
        $finishMoney = $basicDataValue['finishMoney'];

        $odd = $basicDataValue['odds'];
        $bets = $this->getRatioBets($startMoney);


        $round=0;
        $maxMoney = [];

        $case = [
            'round' => $basicDataValue['rounds'],
            'win' => 0,
            'lost' => 0
        ];

        $sumCase = 0;
        $lostNumber = 0;
        $maxRound = 0;
        $minRound = 99999999999;
        $win = 0;
        $lost = 0;

        $winRound = 0;
        $lostRound = 0;

        // ennyi esetet vizsgálunk a paramétereinkkel
        while ($sumCase < $case['round']) {
            $sumCase++;

            //megnézzük hogy az előző esetben mennyi volt a maximális pénz
            if ($sumCase > 1) {
                //hány esetet nyertünk/vesztettünk
                if($actualMoney >= $finishMoney) {
                    $case['win']++;
                } else {
                    $case['lost']++;
                }
            }
            //kör kezdés, tőke alapesetre állitás
            $actualMoney = $startMoney;

            $round = 0;
            $lostNumber=0;

            while ($actualMoney > 0 && $actualMoney < $finishMoney) {
                //tippem, mindig változik
                $myTip = rand(0,1);

                $result = rand(0,1);

                if ($myTip%2 == $result%2) {
                    //eltalálta az eredményt

                    //nettó pénznyeremény
                    $grow = round($bets[$lostNumber] * $odd - $bets[$lostNumber]);

                    $actualMoney = round($actualMoney + $grow);
                    $bets = $this->getRatioBets($actualMoney);
                    $lostNumber=0;
                } else {
                    //nem találtam el az eredményt
                    $actualMoney = round($actualMoney - $bets[$lostNumber]);
                    $grow = - $bets[$lostNumber];
                    if($lostNumber < count($bets)-1) {
                        $lostNumber++;
                    }
                }
                $xx = 0;
            }


            $x=0;
//            while ($actualMoney > 0 && $actualMoney < $finishMoney) {
//
//                //if(lostNumber == 0) {
//                $myTip = rand(0, 1);
//                //}
//                //myTip=0;
//                $result = rand(0,1);
//
//                if ($myTip%2 == $result%2) {
//                    $grow = round($bets[$lostNumber] * $odd - $bets[$lostNumber]);
//                    $actualMoney = round($actualMoney + $grow);
//                    $lostNumber=0;
//                    $win++;
//                    $bets = $this->getBets($actualMoney, $hanyados);
//                } else {
//                    $actualMoney = round($actualMoney - $bets[$lostNumber]);
//                    $grow = - $bets[$lostNumber];
//                    if($lostNumber < count($bets)-1) {
//                        $lostNumber++;
//                    }
//                    $lost++;
//                }
//
//                //if(lostNumber == bets.length) {
//                //lostNumber = 0;
//                //}
//
////                 if (actualMoney > maxMoney) {
////                     maxMoney = actualMoney;
////                 }

        }

        $endTime = $this->milliseconds();
        $case['proportion'] = round((( 100 * $case['win'] ) / ($case['win'] + $case['lost'])), 3) . '%';
        $case['runtime'] = ($endTime-$startTime)/1000 . ' s';

        return $case;
    }

    public function getBets($money, $hanyados)
    {
        if($hanyados)

        return [
            round($money/$hanyados[0]),
            round($money/$hanyados[1]),
            round($money/$hanyados[2]),
            round($money/$hanyados[3]),
            round($money/$hanyados[4]),
            round($money/$hanyados[5]),
            round($money/$hanyados[6])
        ];
    }


    private function getRatioBets($startMoney)
    {
        //hanyados = [100, 45.45, 20.66, 9.39, 4.27, 1.94, 0.88];

        $hanyados = [50, 22.7, 10.33, 4.7, 2.13, 1, 0.44]; // legjobb arány 50%os bejövési arány

        //hanyados = [25.01, 10, 4.17, 1.6, 0.62, 0.28, 0.13];
        //bets = [60.24, 132.82, 292.84, 645.86, 1423.57, 3138.71, 6300, 13000];

        //bets =
        //return [50, 110, 242, 472, 911, 1717, 3216, 5991];

        //bets = [100, 220, 484, 944, 1822, 3424, 6404, 11911];
        //bets = [200, 440, 940, 1800, 3600, 7800];
        //bets = [50, 100, 350, 750, 1500, 3000, 6000, 12000];
        return $this->getBets($startMoney, $hanyados);
    }

    function milliseconds()
    {
        $mt = explode(' ', microtime());
        return ((int)$mt[1]) * 1000 + ((int)round($mt[0] * 1000));
    }

    public function getModel()
    {
        return null;
    }

    public function getModelClass()
    {
        return null;
    }
}