<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Homepage extends Controller
{
    public function showHomePage()
    {
        return View::make('Homepage');
    }
}
