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
        $sql = "select * from public.noticias where status = '1' order by codigo desc limit 5";
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
}
