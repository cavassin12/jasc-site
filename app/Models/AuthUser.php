<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthUser extends Model {

    use HasFactory;

    public function logar(Request $request): RedirectResponse {

        $usuario = $request->email;
        $senha = $request->senha;
        $contemErros = false;
        $stringErros = "";
        if (strlen($senha) < 4) {
            $stringErros = "A Senha deve ser informada";
        } else {
            $senha = sha1($senha);
        }
        if (strlen($usuario) < 5) {
            $stringErros .= "<br>O Email deve ser informado";
        }
        if ($contemErros) {
            return redirect()->to('/auth/login?=1a')->withErrors($stringErros);
        }
        $result = DB::select("select * from public.usuarios where email = ? and senha = ? and status = '1'", [$usuario, $senha]);
        if (count($result) > 0) {
            $d = $result[0];

            $request->session()->put('logado', 1);
            $request->session()->put('usuario_codigo', $d->codigo);
            $request->session()->put('usuario_email', $d->email);
            $request->session()->put('usuario_senha', $d->senha);
            $request->session()->put('usuario_nome', $d->nome);

            return redirect()->to('/painel/geral');
        } else {
            return redirect()->to('/auth/login?podr')->withErrors("Falha", "Dados de acesso não encontrados");
        }
    }

    public function deslogar(Request $request): RedirectResponse {
        $request->session()->put('logado', 0);
        $request->session()->put('usuario_codigo', 0);
        $request->session()->put('usuario_email', 0);
        $request->session()->put('usuario_senha', 0);
        return redirect()->to('/auth/login')->withErrors("Falha", "Sessão Encerrada");
    }
}
