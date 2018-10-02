<?php

namespace App\Http\Controllers;

use App\Repositories\BasicDataRepository;
use App\Transformers\Api\BasicDataTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TacticalCalculatorController extends Controller
{
    public $basicData;
    public $basicDataRepository;
    public $basicDataTransformer;

    public function __construct(
        BasicDataRepository $basicDataRepository,
        BasicDataTransformer $basicDataTransformer
    ) {
        parent::__construct();
        $this->basicDataRepository = $basicDataRepository;
        $this->basicDataTransformer = $basicDataTransformer;

    }

    // behattal betölteni az oldalt, majd leszedni a tartalmát
    public function index(Request $request) 
    {
        $basicData = $this->fractal->collection(
            $this->basicDataRepository->getAll(),
            $this->basicDataTransformer
        );

        $startTime = $this->milliseconds();
        $actualMoney = 5000;
        $startMoney = 5000;
        $round=0;

        $maxMoney = [];

        //hanyados = [100, 45.45, 20.66, 9.39, 4.27, 1.94, 0.88];

        $hanyados = [50, 22.7, 10.33, 4.7, 2.13, 1, 0.44]; // legjobb arány 50%os bejövési arány
        //hanyados = [25.01, 10, 4.17, 1.6, 0.62, 0.28, 0.13];
        //bets = [60.24, 132.82, 292.84, 645.86, 1423.57, 3138.71, 6300, 13000];

        //bets = [50, 110, 242, 472, 911, 1717, 3216, 5991, 11142];

        //bets = [100, 220, 484, 944, 1822, 3424, 6404, 11911];
        //bets = [200, 440, 940, 1800, 3600, 7800];
        //bets = [50, 100, 350, 750, 1500, 3000, 6000, 12000];
        $odd = 1.83;

        $bets = $this->getBets($startMoney, $hanyados);

        $sumCase = 0;
        $lostNumber = 0;
        $maxRound = 0;
        $minRound = 99999999999;
        $win = 0;
        $lost = 0;

        $winRound = 0;
        $lostRound = 0;
        $finishMoney = $actualMoney*3;

        while ($sumCase < 10000) {

            $sumCase++;
            if ($sumCase > 1) {
                $maxMoney[count($maxMoney)] = $actualMoney;
                if($actualMoney >= $finishMoney) {
                    $winRound++;
                } else {
                    $lostRound++;
                }
            }
            $actualMoney = $startMoney;

            if($maxRound < $round) {
                $maxRound = $round;
            }
            if($minRound > $round && $round != 0) {
                $minRound = $round;
            }
            $round = 0;
            $lostNumber=0;
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
////break;
//                //console.log(actualMoney + " " + lostNumber + " g:" + grow);
//                $round++;
//
//                //$("div#round").html(round);
//
//                //$("div#actualMoney").html(actualMoney);
//                //$("div#maxMoney").html(maxMoney);
//                //$("div#lost").html(lost);
//                //$("div#win").html(win);
//            }
            //$("div#sumCase").html(sumCase);

            //$("div#maxRound").html(maxRound);
            //$("div#minRound").html(minRound);

            //$("div#sumRound").html(lost+win);
        }


        //console.log(maxMoney);
        //$("div#lostRound").html(lostRound);
        //$("div#winRound").html(winRound);

        $endTime = $this->milliseconds();
        return view('tactic', ['data' => [
            'basicData' => json_encode($basicData['data'][0]),
            'lostRound' => $lostRound,
            'winRound' => $winRound,
            'proportion' => round(($winRound / $lostRound)*100, 5) . '%',
           // 'runTime' => ($endTime-$startTime)/1000 . ' s'
        ]]);
    }
    
    public function getBets($money, $hanyados) 
    {
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

    function milliseconds() 
    {
        $mt = explode(' ', microtime());
        return ((int)$mt[1]) * 1000 + ((int)round($mt[0] * 1000));
    }
}
