<?php

use Illuminate\Support\Facades\Route;

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}
