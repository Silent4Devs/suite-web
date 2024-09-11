<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class tbApiMobileControllerTest extends Controller
{
    public function test(){
        return json_encode(['data' => 'Sections and questions created successfully'], 200);
    }
}
