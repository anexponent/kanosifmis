<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;

class HookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function createTransaction(Request $request){
        $content = $request->all();
        if($content['code'] == 200){
            $data = $content['data'];
            $qdate = (new \DateTime($data['paymentDate']))->format('Y-m-d');
            $insert = [
                'txnId'=>$data['txnId'],
                'validationNumber'=>$data['validationNumber'],
                'amount'=>$data['amount'],
                'customerName'=>$data['customerName'],
                'revenueHead'=>$data['revenueHead'],
                'bankName'=>$data['bankName'],
                'paymentMethod'=>$data['paymentMethod'],
                'paymentDate'=>$data['paymentDate'],
                'qdate' => $qdate,
                'created_at' => date("Y-m-d h:i"),
            ];
            if (DB::table('transactions')->insertOrIgnore($insert)){
                return response()->json('OK', 200);
            }else{
                return response()->json('Not Ok', 200);
            }
        }
    }

    public function getTransactions(){
        $yesterday = date("Y-m-d", strtotime( '-1 days' ) );
        // $transactions = DB::table('transactions')->whereDate('paymentDate', $yesterday)->get();
        $query = DB::table('transactions')->get();
        $transactions = json_decode($query);
        $result = array_map(function ($transactions) {
            return (array)$transactions;
        }, $result);

        // print_r($result); die();
        $csv = fopen('test.csv', 'w');

        foreach ($data as $row){
            fputcsv($csv, $row);
        }

        fclose($csv);
    }
}
