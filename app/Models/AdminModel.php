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

    public function getAllModalidades() {
        $sql = "select * from public.modalidades order by descricao";
        return DB::select($sql);
    }
}
