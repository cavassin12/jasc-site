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
        $sql = "select n.codigo, n.titulo, (select imagem from public.noticias_images where noticia_codigo = n.codigo and status = '1' order by codigo asc limit 1) as image "
                . "from public.noticias n "
                . "where n.status = '1' "
                . "order by n.codigo desc "
                . "limit 5";
        return DB::select($sql);
    }
    public function getNoticiaById(int $id) {
        $sql = "select * from public.noticias where codigo = ?";
        return DB::select($sql, [$id]);
    }
    public function getBanners() {
        $sql = "select * from public.banners where status = '1' order by codigo asc limit 4";
        return DB::select($sql);
    }
    public function getjogoDestaque() {
        $sql = "select * from public.jogos where status = '1' and destaque = '1' order by codigo desc limit 1";
        return DB::select($sql);
    }
}
