<?php

namespace App\Modules\Cards\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Modules\Core\Http\Controllers\Core;
use App\Modules\Cards\Models\User_cards;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

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
            'user_id' => Auth::user()->id
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

    public function getCards() {

        $limit = (Input::get('length') != '') ? Input::get('length') : 10;
        $offset = (Input::get('start') != '') ? Input::get('start') : 0;
        $search = Input::get('search')['value'];
        $query = User_cards::select('user_cards.id', 'user_cards.card_name', 'user_cards.card_number', 'user_cards.card_limit', 'user_cards.status',
                'user_cards.bill_date', 'user_cards.payment_date', 'card_types.card_type')
                ->leftJoin('card_types', 'card_types.id', '=', 'user_cards.card_type_id')
                ->where('user_id', Auth::user()->id);
        $count = $query->count();
        $data = $query->skip($offset)->take($limit)->get();
        $result = ["iTotalDisplayRecords" => $count, 'data' => $data, "iTotalRecords" => $limit, "TotalDisplayRecords" => $limit];
        return response()->json($result);
    }
    
    /*
     * @function: getCardDetails
     * Get card details
     *
     * @param
     * null
     *
     * @return
     * json 
     */

    public function getCardDetails() {

        $data = [
            'id' => Input::get('id'),
            'user_id' => Auth::user()->id
        ];
        $rules = [
//            'id' => 'required',
//            'user_id' => 'required',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'msg' => implode('<br>', Core::errorMsg($validator))]);
        } else {
            $card_details = User_cards::select()->where($data)->first();
            return response()->json(['status' => 1, 'result' => $card_details]);
        }
    }

}
