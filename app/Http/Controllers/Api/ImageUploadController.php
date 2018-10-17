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
        $image = str_replace('data:image/png;base64,', '', $input['data']['attributes']['image']);
        $image = str_replace(' ', '+', $image);
        $imageName = str_random(10).'.'.'png';
        \File::put(storage_path(). '/app/public/' . $imageName, base64_decode($image));
        return response()->json([
            'status' => 200,
            'value' => 'Sikeres feltöltés!'
        ]);
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
