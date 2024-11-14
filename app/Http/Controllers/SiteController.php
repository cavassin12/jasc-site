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

    public function home(): View {
        $this->sm = new SiteModel();

        return view('site/home', ["banners" => $this->sm->getBanners(),
            "noticias" => $this->sm->getUltimasNoticias(), 
            "jogodest" => $this->sm->getjogoDestaque(),
            "galerias" =>  $this->sm->getGalerias()
        ]);
    }

    public function noticias(): View {
        $this->sm = new SiteModel();
        return view('site/noticias', ["noticias" => $this->sm->getAllNoticias()]);
    }

    public function jogos(): View {
        $this->sm = new SiteModel();
        $hoje = date("Y-m-d");
        return view('site/jogos', ["jogos" => $this->sm->getJogosByDate($hoje)]);
    }

    public function noticiasbyid(Request $request, String $chave): View {
        $this->sm = new SiteModel();
        $id = intval(base64_decode($chave));
        return view('site/noticiabyid', [
            "noticia" => $this->sm->getNoticiaById($id),
            "images" => $this->sm->getNoticiaImagesById($id),
            "outrasnt" => $this->sm->getOutrasNoticiasExcetoId($id)
        ]);
    }
    public function galeriabyid(Request $request, String $chave): View {
        $this->sm = new SiteModel();
        $id = intval(base64_decode($chave));
        return view('site/galeria', [
            "dados" => $this->sm->getGaleriaById($id),
            "image" => $this->sm->getGaleriaImagesById($id),
            
        ]);
    }

    public function classificacao(Request $request): View {
        $this->sm = new SiteModel();
        $id = $request->mod ?? 0;
        return view('site/classificacao', [
            "jogodest" => $this->sm->getjogoDestaque(),
            "modalidades" => $this->sm->getAllModalidades(),
            "classi" => $this->sm->getClassificacoesByModalidade($id)
        ]);
    }
}
