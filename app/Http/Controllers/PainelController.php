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

    public function geral(): View {
        if (session('logado') == 1) {
            $this->sm = new AdminModel();
            return view('admin/geral');
        } else {
            return view('erro');
        }
    }

    public function noticias(): View {
        if (session('logado') == 1) {
            $this->sm = new AdminModel();
            return view('admin/noticiasview', ["itens" => $this->sm->getAllnoticias()]);
        } else {
            return view('erro');
        }
    }

    public function novanoticia(): View {
        return view('admin/noticiascad');
    }

    public function imagensnoticia(String $chave): View {

        return view('admin/noticiasimagens', ["chave" => $chave]);
    }

    public function salvarnoticia(Request $request): RedirectResponse {
        return $this->sm->salvarnoticia($request);
    }

    public function salvarimagem(Request $request): RedirectResponse {
        return $this->sm->salvarimagem($request);
    }

    public function desativarnoticia(Request $request, String $chave): RedirectResponse {
        return $this->sm->desativarnoticia($request, $chave);
    }

    public function desativarimagem(Request $request, String $chave): RedirectResponse {
        return $this->sm->desativarimagem($request, $chave);
    }

    public function desativarjogo(Request $request, String $chave): RedirectResponse {
        return $this->sm->desativarjogo($request, $chave);
    }

    public function destacarjogo(Request $request, String $chave): RedirectResponse {
        return $this->sm->destacarjogo($request, $chave);
    }

    public function jogos(): View {
        if (session('logado') == 1) {
            $this->sm = new AdminModel();
            return view('admin/jogosview', ["itens" => $this->sm->getAllJogos()]);
        } else {
            return view('erro');
        }
    }

    public function novojogo(): View {
        if (session('logado') == 1) {
            return view('admin/jogoscad', ["modalidades" => $this->sm->getAllModalidades(), "cidades" => $this->sm->getAllCidades()]);
        } else {
            return view('erro');
        }
    }

    public function salvarjogo(Request $request): RedirectResponse {
        if (session('logado') == 1) {
            return $this->sm->salvarjogo($request);
        } else {
            return view('erro');
        }
    }
}
