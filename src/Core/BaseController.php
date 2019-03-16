<?php
namespace Core;

use App\Models\DataAccess;

/**
 * The Base Controller.
 */
abstract class BaseController
{
    /**
     * The parameters passed to the controller. These are usually the GET or POST parameters.
     *
     * @var array
     */
    protected $params;

    /**
     * The DataAccess instance used for the controllers.
     *
     * @var DataAccess
     */
    protected $dataAccess;

    /**
     * Initializes a new instance of the BaseController class.
     *
     * @param DataAccess $dataAccess The DataAccess instance.
     */
    public function __construct(DataAccess $dataAccess)
    {
        $this->dataAccess = $dataAccess;
    }

    /**
     * Sets the controller parameters array.
     *
     * @param array $params The parameters array.
     * @return self
     */
    public function withParams(array $params)
    {
        $this->params = $params;
        return $this;
    }

    /**
     * Adds a single parameter to the controller.
     *
     * @param string $name The parameter name.
     * @param $value The parameter value.
     * @return self
     */
    public function withParam(string $name, $value)
    {
        $this->params[$name] = $value;
        return $this;
    }
}