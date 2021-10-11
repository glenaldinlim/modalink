<?php

namespace App\Http\Controllers\Backend;

use App\Models\Bank;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Http\Controllers\Controller;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentMethods = PaymentMethod::with(['bank', 'user'])->get();

        return view('backend.payment-methods.index', [
            'title'             => 'Payment Method',
            'no'                => 1,
            'paymentMethods'    => $paymentMethods
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banks = Bank::where('status', 1)->get();
        $users = User::role(['bod', 'webmaster', 'admin'])->get();

        return view('backend.payment-methods.create', [
            'title' => 'Payment Method',
            'banks' => $banks,
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = \Validator::make($request->all(), [
            'bank'              => 'required|numeric',
            'pic'               => 'required|numeric',
            'account_number'    => 'required|numeric|digits_between:3,50',
            'alias_name'        => 'required|min:3|max:200',
        ])->validate();

        $method = PaymentMethod::create([
            'bank_id'           => $request->get('bank'),
            'user_id'           => $request->get('pic'),
            'account_number'    => $request->get('account_number'),
            'alias_name'        => $request->get('alias_name'),
            'status'            => 1,
        ]);

        return redirect()->route('backend.payments.methods.index')->with('success', 'Successful Added New Payment Method!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        $banks = Bank::where('status', 1)->get();
        $users = User::role(['bod', 'webmaster', 'admin'])->get();

        return view('backend.payment-methods.edit', [
            'title'     => 'Payment Method',
            'no'        => 1,
            'method'    => $paymentMethod,
            'banks' => $banks,
            'users' => $users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = \Validator::make($request->all(), [
            'bank'              => 'required|numeric',
            'pic'               => 'required|numeric',
            'account_number'    => 'required|numeric|digits_between:3,50',
            'alias_name'        => 'required|min:3|max:200',
            'status_option'     => 'required|boolean',
        ])->validate();

        $method = PaymentMethod::whereId($id)
                                    ->update([
                                        'bank_id'           => $request->get('bank'),
                                        'user_id'           => $request->get('pic'),
                                        'account_number'    => $request->get('account_number'),
                                        'alias_name'        => $request->get('alias_name'),
                                        'status'            => $request->get('status_option'),
                                    ]);

        return redirect()->route('backend.payments.methods.index')->with('success', 'Successful Update Payment Method!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
