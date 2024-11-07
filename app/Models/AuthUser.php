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
            return redirect()->to('/auth/login')->withErrors($stringErros);
        }
        $ipuser = $request->ip();
        $result = DB::select("select codigo, email, senha, tipousuario_codigo, nome_completo from public.usuario where email = ? and senha = ? and dtexclusao is null", [$usuario, $senha]);
        if (count($result) > 0) {
            $d = $result[0];

            $request->session()->put('logado', 1);
            $request->session()->put('usuario_codigo', $d->codigo);
            $request->session()->put('usuario_email', $d->email);
            $request->session()->put('usuario_senha', $d->senha);
            $request->session()->put('usuario_tipo', $d->tipousuario_codigo);
            $request->session()->put('usuario_nome', $d->nome_completo);
            $request->session()->put('empresa_codigo', 0);
            $request->session()->put('setor_codigo', 0);
            $request->session()->put('setor_descricao', "");
            $request->session()->put('empresa_qtd', 0);
            $request->session()->put('setor_qtd', 0);

            DB::insert("insert into log.logsystem(usuario_codigo, ip, acao, rotina_codigo)values(?, ?, ?, ?)", [$d->codigo, $ipuser, 'S', 1]);
            if ($d->tipousuario_codigo == 6) {
                return redirect()->to('/definirperfil');
            } else {
                $empresas = DB::select("select empresa_codigo from public.empresa_usuario where dtexclusao is null and usuario_codigo = ?", [$d->codigo]);
                $request->session()->put('empresa_qtd', count($empresas));
                if (count($empresas) > 1) {

                    return redirect()->to('/minhasempresas');
                } else {
                    if (count($empresas) == 1) {
                        $empresa_codigo = $empresas[0]->empresa_codigo;
                        $request->session()->put('empresa_codigo', $empresa_codigo);

                        $setores = DB::select("select codigo, descricao from public.empresa_setores where usuarioresp_codigo = ? and empresa_codigo = ?", [$d->codigo, $empresa_codigo]);
                        $request->session()->put('setor_qtd', count($setores));
                        if (count($setores) >= 1) {
                            $s = $setores[0];
                            $request->session()->put('setor_codigo', $s->codigo);
                            $request->session()->put('setor_descricao', $s->descricao);
                        }
                    }

                    return redirect()->to('/dashboard');
                }
            }
        } else {
            return redirect()->to('/auth/login')->withErrors("Falha", "Dados de acesso não encontrados");
        }
    }

    public function deslogar(Request $request): RedirectResponse {
        $request->session()->put('logado', 0);
        $request->session()->put('usuario_codigo', 0);
        $request->session()->put('usuario_email', 0);
        $request->session()->put('usuario_senha', 0);
        $request->session()->put('usuario_tipo', 0);
        $request->session()->put('empresa_codigo', 0);
        $request->session()->put('setor_codigo', 0);
        return redirect()->to('/auth/login')->withErrors("Falha", "Sessão Encerrada");
    }

    public function salvarCadastro(Request $request): RedirectResponse {

        $email = $request->email;
        $senha = $request->senha;
        $resenha = $request->resenha;
        $nome = $request->nome;
        $telefone = $request->telefone;

        $contemErros = false;
        $stringErros = "";
        if (strlen($senha) < 4) {
            $contemErros = true;
            $stringErros .= "Uma senha válida deve ser informada";
        } else {
            $senha = sha1($senha);
        }
        if (strlen($resenha) < 4) {
            $contemErros = true;
            $stringErros .= "<br>A confirmação de senha válida deve ser informada";
        } else {
            $resenha = sha1($resenha);
        }
        if ($senha != $resenha) {
            $contemErros = true;
            $stringErros .= "As senhas estão diferentes. Tente novamente.";
        } else {
            $resenha = sha1($resenha);
        }

        if (strlen($email) < 5) {
            $contemErros = true;
            $stringErros .= "<br>O Email deve ser informado";
        }
        if ($contemErros) {
            return redirect()->to('/cadastro')->withErrors($stringErros);
        }


        $temUsuario = DB::select("select codigo from public.usuario where email = ?", [$email]);

        if (count($temUsuario) > 0) {
            return redirect()->to('/cadastro')->withErrors("Este email não está liberado para uso. Contate o Suporte.");
        } else {

            $sql = "insert into public.usuario(codigo,email, senha, tipousuario_codigo, nome_completo)values(?, ?, ?, 6, ?);";
            try {
                DB::beginTransaction();
                $codigo = Sistema::getCodigoSequencial("public.usuario_codigo_seq");
                DB::insert($sql, [$codigo, $email, $senha, $nome]);
                //Sistema::gerarLog('I', 2, $codigo, '');
                DB::commit();
                return redirect()->to("/auth/login")->with("sucesso", "Cadastro realizado com sucesso");
            } catch (\Throwable $ex) {
                DB::rollBack();
                return redirect()->to('/cadastro')->withErrors("Um erro aconteceu. Contate o Suporte. " . $ex->getMessage());
            }
        }
    }
}
