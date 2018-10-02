<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\PatchRequest;
use App\Repositories\BaseRepository;
use App\Repositories\BasicDataRepository;
use App\Transformers\Api\BasicDataTransformer;
use App\Transformers\Fractal;
use App\Transformers\ResourceTransformerInterface;
use Illuminate\Http\Request;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Serializer\JsonApiSerializer;

class BasicDataController extends BaseResourceController
{
    public $basicData;
    public $fractal;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->fractal = new Fractal(new ArraySerializer());
    }

    public function index(Request $request)
    {
        return $this->fractal->collection(
                    $this->repository->getAll(),
                    $this->getTransformer()
                );
    }

    public function update(PatchRequest $request, $id)
    {
        $input = $request->input();
        $attributes = ['value' => json_encode($input['data']['attributes'])];
        $this->repository->update($id, $attributes);
        dd();

        $x = 0;
    }

    protected function getTransformer(): ResourceTransformerInterface
    {
        return new BasicDataTransformer();
    }
    protected function getRepository(): BaseRepository
    {
        return new BasicDataRepository();
    }
}
