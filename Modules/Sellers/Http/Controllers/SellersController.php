<?php

namespace Modules\Sellers\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Sellers\Models\Sellers;

class SellersController extends Controller
{
    public function addSeller(){


    }
    public function updateSeller(Request $request){

    }

    public function listSeller(){
        $sellers = Sellers::query()->get()->toArray();

        return view('sellers::sellers')->with('sellers', $sellers);

    }
}