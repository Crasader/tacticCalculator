<?php

namespace App\Http\Controllers\Api;

use App\Repositories\BaseRepository;
use App\Repositories\ImageUploadRepository;
use App\Transformers\ResourceTransformerInterface;
use Illuminate\Http\Request;

class ImageUploadController extends BaseResourceController
{
    public $basicData;
    public $fractal;

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function store(Request $request)
    {
        $input = $request->input();
        $attributes = ['value' => json_encode($input['data']['attributes'])];
        dd();
        //$updated = $this->repository->update($id, $attributes);
        return null;//$this->getUpdateResponse($updated);
    }

    protected function getTransformer(): ResourceTransformerInterface
    {
        return null; //new ImageUploadRepository();
    }
    protected function getRepository(): BaseRepository
    {
        return new ImageUploadRepository();//new BasicDataRepository();
    }
}
