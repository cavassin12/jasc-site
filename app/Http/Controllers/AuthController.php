<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\AuthUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function view;

class AuthController extends Controller {

    private Empresa $ep;

    public function __construct() {
        // $authUser = new AuthUser();
    }

    public function login() {
        return view('admin/login');
    }

    public function logar(Request $request): RedirectResponse {
        $authUser = new AuthUser();
        return $authUser->logar($request);
    }

    public function deslogar(Request $request): RedirectResponse {
        $authUser = new AuthUser();
        return $authUser->deslogar($request);
    }

    
}
