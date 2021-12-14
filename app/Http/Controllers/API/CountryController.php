<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\country;
use Illuminate\Http\Request;

class CountryController extends Controller
{



    public function index()
    {
        $users=country::all();
        return response()->json($users);
    }
}
