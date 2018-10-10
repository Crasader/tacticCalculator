<?php

namespace App\Http\Controllers;

use App\Repositories\BasicDataRepository;
use App\Repositories\TacticDataRepository;
use App\Transformers\Api\BasicDataTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TacticalCalculatorController extends Controller
{
    public $basicData;
    public $basicDataRepository;
    public $tacticDataRepository;
    public $basicDataTransformer;

    public function __construct(
        BasicDataRepository $basicDataRepository,
        BasicDataTransformer $basicDataTransformer,
        TacticDataRepository $tacticDataRepository
    ) {
        parent::__construct();
        $this->basicDataRepository = $basicDataRepository;
        $this->tacticDataRepository = $tacticDataRepository;
        $this->basicDataTransformer = $basicDataTransformer;
    }

    // behattal betölteni az oldalt, majd leszedni a tartalmát
    public function index(Request $request) 
    {
        $basicData = $this->fractal->collection(
            $this->basicDataRepository->getAll(),
            $this->basicDataTransformer
        );

        $basicDataValue = json_decode($basicData['data']['0']['value'], true);
        $tacticData = $this->tacticDataRepository->getTacticData($basicDataValue);

        return view('tactic', ['data' => [
            'basicData' => json_encode($basicData['data'][0]),
            'tacticData' => json_encode($tacticData),
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

    private function getRatioBets($startMoney)
    {
        //hanyados = [100, 45.45, 20.66, 9.39, 4.27, 1.94, 0.88];

        $hanyados = [50, 22.7, 10.33, 4.7, 2.13, 1, 0.44]; // legjobb arány 50%os bejövési arány
        //hanyados = [25.01, 10, 4.17, 1.6, 0.62, 0.28, 0.13];
        //bets = [60.24, 132.82, 292.84, 645.86, 1423.57, 3138.71, 6300, 13000];

        //bets = [50, 110, 242, 472, 911, 1717, 3216, 5991, 11142];

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
}
