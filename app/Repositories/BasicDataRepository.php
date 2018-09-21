<?php

namespace App\Repositories;

use App\Models\BasicData;

class BasicDataRepository extends BaseRepository
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getModelClass()
    {
        return BasicData::class;
    }
}