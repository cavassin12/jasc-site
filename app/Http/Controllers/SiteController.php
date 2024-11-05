<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\SiteModel;
use function view;

class SiteController extends Controller {

    private SiteModel $sm;
    public function __construct() {
        $this->sm = new SiteModel();
    }
   
    public function logar(Request $request): RedirectResponse {
        $authUser = new AuthUser();
        return $authUser->logar($request);
    }
  
    public function home():View {
        $this->sm = new SiteModel();
        
        return view('site/home', ["banners"=> $this->sm->getBanners()]);
    }
    
}
