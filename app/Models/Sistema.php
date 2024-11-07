<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Sistema extends Model {

    use HasFactory;

    public static function getCodigoSequencial($str) {
        try {
            $resultado = DB::select("select nextval(?) as codigo", [$str]);
            if (count($resultado) > 0) {
                return $resultado[0]->codigo;
            }
            return 0;
        } catch (\Throwable $exc) {
            return 0;
        }
    }

    public static function bcrypt($str): String {
        try {
            return Crypt::encryptString($str);
        } catch (DecryptException $exc) {
            return null;
        }
    }

    public static function dcrypt($str): String {
        if ($str == null) {
            return "";
        }
        try {
            return Crypt::decryptString($str);
        } catch (DecryptException $exc) {
            return null;
        }
    }

    public static function toDataHoraBR($str): String {
        $retorno = substr($str, 8, 2);
        $retorno .= "/";
        $retorno .= substr($str, 5, 2);
        $retorno .= "/";
        $retorno .= substr($str, 0, 4);
        $retorno .= " ";
        $retorno .= substr($str, 11, 8);

        return $retorno;
    }

    public static function toDataBR($str): String {
        $retorno = substr($str, 8, 2);
        $retorno .= "/";
        $retorno .= substr($str, 5, 2);
        $retorno .= "/";
        $retorno .= substr($str, 0, 4);

        return $retorno;
    }

    public static function intToStrMes(int $id): String {
        $retorno = "";

        switch ($id) {
            case 1:
                $retorno = "Jan";
                break;
            case 2:
                $retorno = "Fev";
                break;
            case 3:
                $retorno = "Mar";
                break;
            case 4:
                $retorno = "Abr";
                break;
            case 5:
                $retorno = "Mai";
                break;
            case 6:
                $retorno = "Jun";
                break;
            case 7:
                $retorno = "Jul";
                break;
            case 8:
                $retorno = "Ago";
                break;
            case 9:
                $retorno = "Set";
                break;
            case 10:
                $retorno = "Out";
                break;
            case 11:
                $retorno = "Nov";
                break;
            case 12:
                $retorno = "Dez";
                break;

            default:
                break;
        }

        return $retorno;
        ;
    }
}
