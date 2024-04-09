<?php

namespace App\Http\Controllers;

use App\Models\Sellers;
use Illuminate\Http\Request;

class SellersController extends Controller
{
    public function addSeller(){


    }
    public function updateSeller(Request $request){

    }

    public function listSeller(){
        $sellers = Sellers::query()->get()->toArray();

        return view('pages.sellers')->with('sellers', $sellers);

    }
}