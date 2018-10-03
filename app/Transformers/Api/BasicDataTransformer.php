<?php

namespace App\Transformers\Api;

use App\Models\BasicData;
use App\Transformers\Api\BaseResourceTransformer;
use App\Transformers\ResourceTransformerInterface;

class BasicDataTransformer extends BaseResourceTransformer implements ResourceTransformerInterface
{

    public static function getResourceKey()
    {
        return 'basic-data';
    }

    public function transform(BasicData $basicData)
    {
        return [
            'id' => $basicData->id,
            'type' => $basicData->key,
            'value' => $basicData->value
        ];
    }
}
