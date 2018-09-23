<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseResourceController;
use App\Repositories\BaseRepository;
use App\Repositories\BasicDataRepository;
use App\Transformers\ResourceTransformerInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BasicDataController extends BaseResourceController
{
    public $basicData;

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function index(Request $request)
    {
        print_r("asdads");
    }

    protected function getTransformer(): ResourceTransformerInterface
    {
        // TODO: Implement getTransformer() method.

    }
    protected function getRepository(): BaseRepository
    {
        return new BasicDataRepository();
    }
}
