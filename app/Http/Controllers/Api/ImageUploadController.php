<?php

namespace App\Http\Controllers\Api;

use App\Repositories\BaseRepository;
use App\Repositories\ImageUploadRepository;
use App\Transformers\ResourceTransformerInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends BaseResourceController
{
    public $basicData;
    public $fractal;

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function index(Request $request)
    {
        return response()->json(
                $this->replaceText(Storage::allFiles('public/images'))
            );
    }

    private function replaceText($exists)
    {
        $images = [];
        foreach ($exists as $exist) {
            $images[] = str_replace('public', 'storage', $exist);
        }
        return $images;
    }

    public function store(Request $request)
    {
        $input = $request->input();
        $extension = explode(';', $input['data']['attributes']['image']);
        $extension = explode('/', $extension[0]);
        $extension = $extension[1];
        $image = str_replace('data:image/' . $extension . ';base64,', '', $input['data']['attributes']['image']);
        $image = str_replace(' ', '+', $image);

        $imageName = str_random(10).'.'.$extension;
        \File::put(storage_path(). '/app/public/images/' . $imageName, base64_decode($image));

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
