<?php

namespace App\Http\Controllers\Api;

<<<<<<< HEAD
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
=======
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
use Symfony\Component\HttpKernel\Exception\HttpException;

class Controller extends BaseController
{
<<<<<<< HEAD
    public function errorResponse($statusCode,$message=null,$code=0)
    {
        throw new HttpException($statusCode,$message,null,[],$code);
=======
    public function errorResponse($statusCode, $message=null, $code=0)
    {
        throw new HttpException($statusCode, $message, null, [], $code);
>>>>>>> f2c8031f97e0ba5e7b887e71a847a0cc605b6531
    }
}
