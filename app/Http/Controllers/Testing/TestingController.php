<?php

namespace App\Http\Controllers\Testing;

use App\Http\Controllers\Controller;
use App\Zaions\Helpers\ZHelpers;
use Illuminate\Http\Request;

class TestingController extends Controller
{
    //
    public function test()
    {
        return ZHelpers::sendBackRequestCompletedResponse([
            'items' => [['id' => 'one'], ['id' => 'two']],
        ]);
    }
}
