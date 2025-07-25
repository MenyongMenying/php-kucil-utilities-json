<?php

namespace MenyongMenying\MLibrary\Kucil\Utilities\Json\Contracts;

use MenyongMenying\MLibrary\Kucil\Utilities\MArray\MArray;
use MenyongMenying\MLibrary\Kucil\Utilities\MObject\MObject;

/**
 * @author MenyongMenying <menyongmenying.main@email.com>
 * @version 0.0.1
 * @date 2025-07-30
 */
interface JsonInterface
{
    /**
     * Undocumented function
     * @param  MArray $mArray
     * @param  MObject $mObject
     * @return void
     */
    public function __construct(MArray $mArray, MObject $mObject);

    /**
     * Mengecek apakah suatu string merupakan JSON.
     * @param  string    $json String yang akan dicek.
     * @return null|bool       Hasil pengecekan.
     */
    public function isJson(string $json) :null|bool;

    /**
     * Melakukan encode data ke dalam JSON.
     * @param  array       $data   Array yang akan diencode.
     * @param  int         $option 
     * @param  int         $depth  
     * @return null|string         
     */
    public function encode(array $data, int $option = 0, int $depth = 512) :null|string;

    /**
     * Melakukan decode string JSON.
     * @param  string $json       String yang akan didecode.
     * @param  bool   $assosiatif Melakukan konvert hasil decode ke array atau tidak.   
     * @param  int    $dept       
     * @param  int    $flags      
     * @return mixed              
     */
    public function decode(string $json, bool $assosiatif = false, int $dept = 512, int $flags = 0) :mixed;

    /**
     * Meneruskan kode error terakhir dari proses JSON.
     * @return null|int Kode error terakhir dari proses JSON.
     */
    public function getLastError() :null|int;

    /**
     * Meneruskan pesan error terakhir dari proses JSON.
     * @return null|string Pesan error terakhir dari proses JSON.
     */
    public function getLastErrorMessage() :null|string;

    /**
     * Mengecek apakah decode JSON menghasilakn error.
     * @return null|bool 
     */
    public function hasError() :null|bool;
}