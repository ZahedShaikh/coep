<?php

namespace App\Http\Controllers;

use App\transaction_history;
use Illuminate\Http\Request;

class transactionhistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\transaction_history  $transaction_history
     * @return \Illuminate\Http\Response
     */
    public function show(transaction_history $transaction_history)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\transaction_history  $transaction_history
     * @return \Illuminate\Http\Response
     */
    public function edit(transaction_history $transaction_history)
    {
        return view('vendor.multiauth.admin.amountDistribution');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\transaction_history  $transaction_history
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, transaction_history $transaction_history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\transaction_history  $transaction_history
     * @return \Illuminate\Http\Response
     */
    public function destroy(transaction_history $transaction_history)
    {
        //
    }
}
