<?php

namespace App\Modules\Cards\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Modules\Core\Http\Controllers\Core;
use App\Modules\Cards\Models\User_cards;

class Cards extends Controller {
    /*
     * @function: index
     * Show cards list
     *
     * @param
     * null
     *
     * @return
     * view 
     */

    public function index() {
        return view('cards::cards_list');
    }

    /*
     * @function: saveCard
     * Save card details
     *
     * @param
     * null
     *
     * @return
     * json 
     */

    public function saveCard() {

        $data = [
            'card_name' => Input::get('card_name'),
            'card_number' => Input::get('card_number'),
            'card_limit' => Input::get('card_limit'),
            'bill_date' => Input::get('bill_date'),
            'payment_date' => Input::get('payment_date'),
            'card_type_id' => Input::get('card_type'),
            'bank_id' => Input::get('bank'),
        ];
        $rules = [
            'card_name' => 'required',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'msg' => implode('<br>', Core::errorMsg($validator))]);
        } else {
            User_cards::create($data);
            return response()->json(['status' => 1, 'result' => '', 'msg' => 'Card added successfully']);
        }
    }

}
