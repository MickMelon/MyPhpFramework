<?php
namespace Framework\Core;

use Framework\App\Models\DataAccess;

abstract class BaseController
{
    protected $params;
    protected $dataAccess;

    public function __construct(DataAccess $dataAccess)
    {
        $this->dataAccess = $dataAccess;
    }

    public function withParams($params)
    {
        $this->params = $params;
    }
}