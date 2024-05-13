<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if(auth()->check()){
            $user = auth()->user();
            return redirect($user->role);
        }else{
            return redirect('admin/login');
        }
    }
}
