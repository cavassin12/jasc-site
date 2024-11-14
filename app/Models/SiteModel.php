<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class SiteModel extends Model {

    use HasFactory;

    public function getUltimasNoticias() {
        $sql = "select n.codigo, n.titulo, n.dt_record, n.texto,  "
                . "coalesce((select concat('galeria/', noticia_codigo, '/', g.imagem) as imagem from public.noticias_images g where g.noticia_codigo = n.codigo and g.status = '1' order by g.codigo asc limit 1), 'galeria/ConcordiaJascBanner.jpg') as image "
                . "from public.noticias n "
                . "where n.status = '1' "
                . "order by n.codigo desc "
                . "limit 5";
        return DB::select($sql);
    }

    public function getAllNoticias() {
        $sql = "select n.codigo, n.titulo, n.dt_record, n.texto, "
                . "coalesce((select concat('galeria/', noticia_codigo, '/', imagem) as imagem from public.noticias_images where noticia_codigo = n.codigo and status = '1' order by codigo asc limit 1), 'galeria/ConcordiaJascBanner.jpg') as image "
                . "from public.noticias n "
                . "where n.status = '1' "
                . "order by n.codigo desc "
                . "limit 10";
        return DB::select($sql);
    }

    public function getNoticiaById(int $id) {
        $sql = "select n.*, "
                . "coalesce((select concat('galeria/', noticia_codigo, '/', imagem) as imagem from public.noticias_images where noticia_codigo = n.codigo and status = '1' order by codigo asc limit 1), 'galeria/ConcordiaJascBanner.jpg') as capa "
                . "from public.noticias n "
                . "where n.codigo = ?";
        return DB::select($sql, [$id]);
    }
    public function getNoticiaImagesById(int $id) {
        $sql = "select n.*, concat('galeria/', n.noticia_codigo, '/', n.imagem) as ds_imagem  "
                . "from public.noticias_images n "
                . "where n.noticia_codigo = ? and n.status = '1'";
        return DB::select($sql, [$id]);
    }

    public function getOutrasNoticiasExcetoId(int $id) {
        $sql = "select n.*, '/upload/galeria/ConcordiaJascBanner.jpg' as capa "
                //. "(select imagem from public.noticias_images where noticia_codigo = n.codigo and status = '1' order by codigo asc limit 1) as capa "
                . "from public.noticias n "
                . "where n.status = '1' "
                . "and n.codigo <> ? "
                . "order by n.codigo desc limit 4";
        return DB::select($sql, [$id]);
    }

    public function getBanners() {
        $sql = "select * from public.banners where status = '1' order by codigo asc limit 4";
        return DB::select($sql);
    }

    public function getGalerias() {
        $sql = "select g.*, "
                . "coalesce((select concat(gi.galeria, '/', gi.link_img) as link from public.galerias_imagens gi where gi.galeria = g.codigo order by gi.codigo asc limit 1), '/upload/galeria/ConcordiaJascBanner.jpg') as capa "
                . "from public.galerias g "
                . "where g.status = '1' order by g.codigo desc limit 5";
        return DB::select($sql);
    }

    public function getjogoDestaque() {
        $sql = "select j.*, ca.descricao as cidade_a, cb.descricao as cidade_b, m.descricao as nm_modalidade "
                . "from public.jogos j "
                . "inner join public.cidades ca on ca.codigo = j.cidade_a_codigo "
                . "inner join public.cidades cb on cb.codigo = j.cidade_b_codigo "
                . "inner join public.modalidades m on m.codigo = j.modalidade_codigo "
                . "where j.destaque = '1' "
                . "order by j.codigo desc limit 1";
        return DB::select($sql);
    }

    public function getJogosByDate($data) {

        $sql = "select j.*, ca.descricao as cidade_a, cb.descricao as cidade_b, m.descricao as nm_modalidade "
                . "from public.jogos j "
                . "inner join public.cidades ca on ca.codigo = j.cidade_a_codigo "
                . "inner join public.cidades cb on cb.codigo = j.cidade_b_codigo "
                . "inner join public.modalidades m on m.codigo = j.modalidade_codigo "
                . "where data = '{$data}' and j.status = '1' "
                . "order by j.data asc, hora asc, codigo asc";
        return DB::select($sql);
    }

    public function getClassificacoesByModalidade($id) {
        $sql = "select j.*, ca.descricao as cidade_nome "
                . "from public.jogos_classificacao j "
                . "inner join public.cidades ca on ca.codigo = j.cidade "
                . "where j.modalidade = ? "
                . "order by posicao desc";
        return DB::select($sql, [$id]);
    }

    public function getAllModalidades() {
        $sql = "select * from public.modalidades  order by descricao";
        return DB::select($sql);
    }
    public function getGaleriaById(int $id) {
        $sql = "select * from public.galerias where codigo = ? and status = '1'";
        return DB::select($sql, [$id]);
    }
    public function getGaleriaImagesById(int $id) {
        $sql = "select * from public.galerias_imagens where galeria = ?";
        return DB::select($sql, [$id]);
    }
    
    
}
