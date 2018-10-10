<?php

namespace App\Http\Controllers\Api;

use App\Repositories\BaseRepository;
use App\Repositories\BasicDataRepository;
use App\Repositories\TacticDataRepository;
use App\Transformers\Api\BasicDataTransformer;
use App\Transformers\Fractal;
use App\Transformers\ResourceTransformerInterface;
use Illuminate\Http\Request;
use League\Fractal\Serializer\ArraySerializer;

class TacticDataController extends BaseResourceController
{
    public $tacticData;
    public $fractal;
    public $repository;
    public $basicDataRepository;
    public $basicDataTransformer;

    public function __construct(
        Request $request,
        TacticDataRepository $tacticDataRepository,
        BasicDataRepository $basicDataRepository,
        BasicDataTransformer $basicDataTransformer
    ){
        parent::__construct($request);
        $this->fractal = new Fractal(new ArraySerializer());
        $this->repository = $tacticDataRepository;
        $this->basicDataTransformer = $basicDataTransformer;
        $this->basicDataRepository = $basicDataRepository;
    }

    public function index(Request $request)
    {
        $basicData = $this->fractal->collection(
            $this->basicDataRepository->getAll(),
            $this->basicDataTransformer
        );
        $basicDataValue = json_decode($basicData['data']['0']['value'], true);
        return $this->repository->getTacticData($basicDataValue);
    }

    protected function getTransformer(): ResourceTransformerInterface
    {
        return new BasicDataTransformer();
    }
    protected function getRepository(): BaseRepository
    {
        return new TacticDataRepository();
    }
}
