<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function view;

class SiteController extends Controller {

    public function __construct() {
    }
   
    public function logar(Request $request): RedirectResponse {
        $authUser = new AuthUser();
        return $authUser->logar($request);
    }
  
    public function home():View {
        return view('site/home');
    }
    
}
