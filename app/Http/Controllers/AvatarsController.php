<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class AvatarsController extends Controller{
    
    public function update(Request $req){
    	$path = $request->file('avatar')->store('avatars');
        return $path;
    }
}
