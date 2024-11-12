<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\AuthUser;
use App\Models\SiteModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function view;

class PainelController extends Controller {

    private AdminModel $sm;
    public function __construct() {
        $this->sm = new AdminModel();
    }
   
    public function geral():View {
        $this->sm = new AdminModel();
        
        return view('admin/geral');
    }
    public function noticias():View {
        $this->sm = new SiteModel();
        return view('site/home', ["banners"=> $this->sm->getBanners(), "noticias"=>$this->sm->getUltimasNoticias()]);
    }
    
}
