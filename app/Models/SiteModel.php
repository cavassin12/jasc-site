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
        $sql = "select * from tipos.tiporespostas order by descricao asc";
        return DB::select($sql);
    }
}
