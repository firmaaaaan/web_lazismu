<?php

namespace App\Http\Controllers;

use App\Models\Dokumentasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ImageController extends Controller
{
    public function store( Request $request){
        $doks= new Dokumentasi();
        $doks->id=0;
        $doks->exists= true;
        $image=$doks->addMediaFromRequest( key:'upload')->toMediaCollection();
        
        return response()->json([
            'url' =>$image->getUrl()
        ]);

    }
}