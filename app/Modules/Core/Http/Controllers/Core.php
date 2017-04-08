<?php

namespace App\Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Core extends Controller {

    public static function errorMsg($validator) {
        $error = [];
        foreach (array_values($validator->messages()->toArray()) as $msg) {
            $error = array_merge($error, $msg);
        }
        return $error;
    }

}
