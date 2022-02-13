<?php

namespace App\Models;

use App\Requests\Product\IndexRequest;
use JsonMapper;
use JsonMapper_Exception;
use ReflectionException;
use Symfony\Component\HttpFoundation\ParameterBag;
use ReflectionClass;
use RuntimeException;


class JsonDataTransferObjectMapper implements DataTransferObjectMapper
{

    public function map($object, $request)
    {
        try {
            $mapper = new JsonMapper();
            $mapper->bIgnoreVisibility = true;

            return $mapper->map(
                new ParameterBag($request),
                (new ReflectionClass($object))->newInstanceWithoutConstructor()
            );
        } catch (JsonMapper_Exception|ReflectionException $e) {
            throw new RuntimeException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
