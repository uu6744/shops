<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Request\TestRequest;

class TestController extends Controller
{
    public function edit(TestRequest $req)
    {
        dd($req->all());
    }
}
