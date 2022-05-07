<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use App\Http\Requests\StoreTransferRequest;
use App\Http\Requests\UpdateTransferRequest;
use App\Http\Resources\TransferResource;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transfers = json_encode(TransferResource::collection(Transfer::orderBy('created_at', 'desc')->get())) ;
        return view('welcome')->with("transfers", $transfers) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $id)
    {
        $accounts = json_encode(UserResource::collection(User::all())) ;
        $user = json_encode(User::find($id)) ;
        return view('welcome')-> with([
            'user' => $user,
            "accounts" => $accounts 
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransferRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransferRequest $request)
    {

        // $transfer = new Transfer;
        DB::transaction(function () use ($request) {
            // $request['created_at'] = now() ;
            // $request['updated_at'] = now() ;
            // $request['amount'] = floatval($request['amount']) * 100 ;
            $data = [
                'created_at' => now() ,
                'updated_at' => now() ,
                'amount' => floatval($request['amount']) * 100 ,
                'user_from' => $request['user_from'],
                'user_to' => $request['user_to'],
            ];
            $transfer = Transfer::create($data);
            
            $sender = User::find(intval($data['user_from'])) ;
            $sender->current_balance = $sender->current_balance - $data['amount'] ;
            $sender['updated_at'] = now() ;
            $sender->save();
            
            $receiver = User::find(intval($request['user_to'])) ;
            $receiver->current_balance = $receiver->current_balance + $data['amount'] ;
            $receiver['updated_at'] = now() ;
            $receiver->save();
        });
        // return new TransferResource(Transfer::latest()->first()) ;
        return redirect('/transfers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function show(Transfer $transfer)
    {
        // return view('welcome')->with("transfer", $transfer) ;
        return new TransferResource($transfer) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function edit(Transfer $transfer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransferRequest  $request
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransferRequest $request, Transfer $transfer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transfer $transfer)
    {
        //
    }
}
