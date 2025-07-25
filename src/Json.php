<?php

namespace MenyongMenying\MLibrary\Kucil\Utilities\Json;

use MenyongMenying\MLibrary\Kucil\Utilities\Json\Contracts\JsonInterface;
use MenyongMenying\MLibrary\Kucil\Utilities\Data\Data;
use MenyongMenying\MLibrary\Kucil\Utilities\MArray\MArray;
use MenyongMenying\MLibrary\Kucil\Utilities\MObject\MObject;

/**
 * @author MenyongMenying <menyongmenying.main@email.com>
 * @version 0.0.1
 * @date 2025-07-20
 */
final class Json implements JsonInterface
{
    /**
     * Objek dari class 'MArray'.
     * @var \MenyongMenying\MLibrary\Kucil\Utilities\MArray\MArray 
     */
    private MArray $mArray;

    /**
     * Objek dari class 'MObject'.
     * @var \MenyongMenying\MLibrary\Kucil\Utilities\MObject\MObject 
     */
    private MObject $mObject;

    /**
     * @param  MArray $mArray
     * @param  MObject $mObject 
     * @return void
     */
    public function __construct(MArray $mArray, MObject $mObject)
    {
        $this->mArray = $mArray;
        $this->mObject = $mObject;
        return;
    }

    public function isJson(string $json) :null|bool
    {
        $this->decode($json);
        return JSON_ERROR_NONE === $this->getLastError();
    }

    public function encode(array $data, int $option = 0, int $depth = 512) :null|string
    {
        $result = json_encode($data, $option, $depth);
        switch (true) {
            case $this->mArray->isEmpty($data):
                return '{}';
            case !$this->mArray->isArrayAssociative($data):
                return throw new \Exception('Data yang diberikan bukan array asosiatif.');
            case JSON_ERROR_NONE === $this->getLastError():
                return $result;
            default:
                return null;
        }
        return null;
    }

    public function decode(string $json, bool $assosiatif = false, int $dept = 512, int $flags = 0) :mixed
    {
        $result = json_decode($json, false, $dept, $flags);
        if ($this->getLastError() === JSON_ERROR_NONE) {
            if ($assosiatif) {
                return $this->mObject->convertToArray($result);
            }
            return new Data($result);
        }
        return null;
    }

    public function getLastError() :null|int
    {
        return json_last_error();
    }

    public function getLastErrorMessage() :null|string
    {
        return json_last_error_msg();
    }

    public function hasError() :null|bool
    {
        if (json_last_error() === JSON_ERROR_NONE) {
            return false;
        }
        return true;
    }
}