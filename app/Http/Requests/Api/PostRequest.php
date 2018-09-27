<?php

namespace App\Http\Requests\Api;

class PostRequest extends ApiRequest
{
    /**
     * Add custom rules.
     *
     * @return array
     */
    protected function addRules(): array
    {
        return ['data.attributes' => 'required'];
    }
}
