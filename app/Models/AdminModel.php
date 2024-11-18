<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class AdminModel extends Model {

    use HasFactory;
//    private $localpublic = "jascconcordia.com.br";
    private $localpublic = "jasc.vandecavassin.com.br";

    public function getAllModalidades() {
        $sql = "select * from public.modalidades order by descricao asc";
        return DB::select($sql);
    }
    public function getAllCidades() {
        $sql = "select * from public.cidades order by descricao asc";
        return DB::select($sql);
    }

    public function getAllnoticias() {
        $sql = "select * from public.noticias order by codigo desc";
        return DB::select($sql);
    }
    public function getAllGalerias() {
        $sql = "select * from public.galerias order by codigo desc";
        return DB::select($sql);
    }

    public function salvarnoticia(Request $request): RedirectResponse {
        $codigo = intval(base64_decode($request->codigo));
        $titulo = strip_tags($request->titulo);
        $conteudo = $request->conteudo;
//        $data = $request->dt_not;

        $sql = "insert into public.noticias(titulo, texto, usuario, status)values(?, ?, ?, ?)";
        try {
            DB::insert($sql, [$titulo, $conteudo, 1, '1']);
            return redirect()->to("/painel/noticias?ok")->with("sucesso", "Noticia Cadastrada");
        } catch (\Throwable $ex) {
//            var_dump($ex->getMessage());
            return redirect()->back()->with("falha", "Um erro aconteceu: " . $ex->getMessage());
        }
    }
    
    public function salvarjogo(Request $request): RedirectResponse {
        $cidadea = intval(base64_decode($request->cidadea));
        $cidadeb = intval(base64_decode($request->cidadeb));
        
        $data = $request->data;
        $hora = $request->hora;
        $local = $request->local;
        $link = $request->link;
        
        $modalidade = intval(base64_decode($request->modalidade));

        $sql = "insert into public.jogos(modalidade_codigo, data, hora, local, cidade_a_codigo, cidade_b_codigo, link_transmissao, status)values(?, ?, ?, ?, ?, ?, ?, ?)";
        try {
            DB::insert($sql, [$modalidade, $data, $hora, $local, $cidadea, $cidadeb, $link, 1]);
            return redirect()->to("/painel/jogos?ok")->with("sucesso", "Noticia Cadastrada");
        } catch (\Throwable $ex) {
            var_dump($ex->getMessage());
            return redirect()->back()->with("falha", "Um erro aconteceu: " . $ex->getMessage());
        }
    }
    public function galeriassalvar(Request $request): RedirectResponse {
        
        $data = $request->data;
        $descricao = $request->descricao;
        
        $sql = "insert into public.galerias(data, descricao, status)values(?, ?, ?)";
        try {
            DB::insert($sql, [$data, $descricao, 1]);
            return redirect()->to("/painel/galeria?ok")->with("sucesso", "Galeria Cadastrada");
        } catch (\Throwable $ex) {
            var_dump($ex->getMessage());
            return redirect()->back()->with("falha", "Um erro aconteceu: " . $ex->getMessage());
        }
    }

    public function desativarnoticia(Request $request, String $chave): RedirectResponse {
        $codigo = intval(base64_decode($chave));

        $sql = "update public.noticias set status = '0' where codigo = ?";
        try {
            DB::update($sql, [$codigo]);
            return redirect()->to("/painel/noticias?ok")->with("sucesso", "Noticia Cadastrada");
        } catch (\Throwable $ex) {
            return redirect()->back()->with("falha", "Um erro aconteceu: " . $ex->getMessage());
        }
    }

    public function desativarimagem(Request $request, String $chave): RedirectResponse {
        $codigo = intval(base64_decode($chave));

        $sql = "update public.noticias_images set status = '0' where codigo = ?";
        try {
            DB::update($sql, [$codigo]);
            return redirect()->to("/painel/jogos?ok")->with("sucesso", "Imagem Alterada");
        } catch (\Throwable $ex) {
            return redirect()->back()->with("falha", "Um erro aconteceu: " . $ex->getMessage());
        }
    }
    public function desativarjogo(Request $request, String $chave): RedirectResponse {
        $codigo = intval(base64_decode($chave));

        $sql = "update public.jogos set status = '0' where codigo = ?";
        try {
            DB::update($sql, [$codigo]);
            return redirect()->to("/painel/jogos?ok")->with("sucesso", "Imagem Alterada");
        } catch (\Throwable $ex) {
            return redirect()->back()->with("falha", "Um erro aconteceu: " . $ex->getMessage());
        }
    }
    public function destacarjogo(Request $request, String $chave): RedirectResponse {
        $codigo = intval(base64_decode($chave));

        $sql = "update public.jogos set destaque = '1' where codigo = ?";
        try {
            DB::update("update public.jogos set destaque = '0'");
            DB::update($sql, [$codigo]);
            return redirect()->to("/painel/jogos?ok")->with("sucesso", "Imagem Alterada");
        } catch (\Throwable $ex) {
            return redirect()->back()->with("falha", "Um erro aconteceu: " . $ex->getMessage());
        }
    }

    public function salvarimagem(Request $request): RedirectResponse {
        $codigo = intval(base64_decode($request->noticia_codigo));

        try {
            $file = $request->file('file');

            $path = Storage::disk('galerias')->putFile('/' . $codigo, $file);
            chmod('/home/admin/web/'.$this->localpublic.'/public_html/upload/galeria/'.$codigo, 0755);
            
            $exp = explode("/", $path);
            
            DB::insert("insert into public.noticias_images(noticia_codigo, imagem, status)values(?, ?, ?)", [$codigo, $exp[1], '1']);
            return redirect()->to("/painel/noticias?ok")->with("sucesso", "Imagem Alterada");
        } catch (\Throwable $exc) {
            return redirect()->back()->with("falha", "Um erro aconteceu: " . $ex->getMessage());
        }
    }
    
    public function salvarimagemgaleria(Request $request): RedirectResponse {
        $codigo = intval(base64_decode($request->galeria_codigo));

        try {
            $file = $request->file('file');

            $path = Storage::disk('galerias')->putFile('/' . $codigo, $file);
            chmod('/home/admin/web/jasc.vandecavassin.com.br/public_html/upload/galeria/'.$codigo, 0755);
            
            $exp = explode("/", $path);
            
            DB::insert("insert into public.galerias_imagens(galeria, link_img)values(?, ?)", [$codigo, $exp[1]]);
            return redirect()->to("/painel/galeria?ok")->with("sucesso", "Imagem Alterada");
        } catch (\Throwable $exc) {
//            var_dump($exc);
            return redirect()->back()->with("falha", "Um erro aconteceu: " . $ex->getMessage());
        }
    }
    
    public function getAllJogos(){
        $sql = "select j.*, ca.descricao as cidade_a, cb.descricao as cidade_b, m.descricao as nm_modalidade "
                . "from public.jogos j "
                . "inner join public.cidades ca on ca.codigo = j.cidade_a_codigo "
                . "inner join public.cidades cb on cb.codigo = j.cidade_b_codigo "
                . "inner join public.modalidades m on m.codigo = j.modalidade_codigo "
                . "order by j.codigo desc limit 50";
        return DB::select($sql);
    }
}
