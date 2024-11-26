<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;


class TransactionDetailController extends Controller
{
    //
    public function index()
    {
        return view('transaction-details.index');
    }

    public function   fetchTransactionDetails(Request $request, UserService $userService)
    {
        $input = $request->all();
        $input['order_id'] = decrypt($input['order_id']);
        $get_transaction_by_order = $userService->getTransactionByOrder($input['order_id']);
        $data2 =  view('partials._get_transaction_by_order_by_id_details')
            ->with(compact('get_transaction_by_order'))
            ->render();
        return response()->json(['data' => $data2]);
    }
}
