<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\SiteModel;
use function view;

class PainelController extends Controller {

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
        
        return view('site/home', ["banners"=> $this->sm->getBanners(), 
            "noticias"=>$this->sm->getUltimasNoticias(), 
            "jogodest"=> $this->sm->getjogoDestaque(),
            "galerias"=>$this->sm->getGalerias()]);
    }
    public function noticias():View {
        $this->sm = new SiteModel();
        return view('site/home', ["banners"=> $this->sm->getBanners(), "noticias"=>$this->sm->getUltimasNoticias()]);
    }
    public function noticiasbyid(Request $request, String $chave):View {
        $this->sm = new SiteModel();
        $id = intval(base64_decode($chave));
        return view('site/noticiabyid', [
            "noticia"=>$this->sm->getNoticiaById($id), 
            "outrasnt"=>$this->sm->getOutrasNoticiasExcetoId($id)
                ]);
    }
    
}