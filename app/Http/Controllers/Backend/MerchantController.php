<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Status;
use App\Models\Merchant;
use App\Models\BusinessType;
use Illuminate\Http\Request;
use App\Models\BusinessCategory;
use App\Models\VerificationStatus;
use App\Http\Controllers\Controller;

class MerchantController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('role:webmaster|admin');
        $this->middleware('auth')->except(['create', 'show', 'store', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $merchants = Merchant::with(['status', 'businessCategory'])->get();
        // $merchants = Merchant::all();

        return view('backend.merchants.index', [
            'title' => 'Merchant',
            'no' => 1,
            'merchants' => $merchants,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $businessTypes = BusinessType::where('status', 1)->get();
        $businessCategories = BusinessCategory::where('status', 1)->get();

        return view('backend.merchants.create', [
            'title'                 => 'Merchant',
            'businessTypes'         => $businessTypes,
            'businessCategories'    => $businessCategories,
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
            'owner_name'        => 'required|min:3|max:250',
            'email'             => 'required|email|unique:users,email',
            'owner_phone'       => 'required|max:16|regex:/^[0-9]*$/',
            'merchant_name'     => 'required|min:3|max:250',
            'merchant_phone'    => 'required|max:16|regex:/^[0-9]*$/',
            'year'              => 'required|regex:/^[0-9]*$/',
            'business_type'     => 'required|regex:/^[0-9]*$/',
            'business_category' => 'required|regex:/^[0-9]*$/',
        ])->validate();

        $user = User::create([
            'name'      => $request->get('owner_name'),
            'email'     => $request->get('email'),
            'phone'     => $request->get('owner_phone'),
            'password'  => \Hash::make('merchant.modalink00'),
        ]);
        $user->assignRole('merchant');

        $merchant = Merchant::create([
            'user_id'                   => $user->id,
            'name'                      => $request->get('merchant_name'),
            'phone'                     => $request->get('merchant_phone'),
            'since'                     => $request->get('year'),
            'business_type_id'          => $request->get('business_type'),
            'business_category_id'      => $request->get('business_category'),
            'status_id'                 => 1,
            'verification_status_id'    => 1,
        ]);

        return redirect()->route('backend.merchants.index')->with('success', 'Successful Added New Merchant!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $merchant = Merchant::findOrFail($id);

        return view('backend.merchants.show', [
            'title' => 'Merchant',
            'merchant' => $merchant,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $merchant = Merchant::findOrFail($id);
        $businessTypes = BusinessType::where('status', 1)->get();
        $businessCategories = BusinessCategory::where('status', 1)->get();
        $statuses = Status::all();

        return view('backend.merchants.edit', [
            'title'                 => 'Merchant',
            'merchant'              => $merchant,
            'businessTypes'         => $businessTypes,
            'businessCategories'    => $businessCategories,
            'statuses'              => $statuses,
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
            'merchant_name'     => 'required|min:3|max:250',
            'merchant_phone'    => 'required|max:16|regex:/^[0-9]*$/',
            'year'              => 'required|regex:/^[0-9]*$/',
            'business_type'     => 'required|regex:/^[0-9]*$/',
            'business_category' => 'required|regex:/^[0-9]*$/',
            'status'            => 'required|regex:/^[0-9]*$/',
        ])->validate();

        $merchant = Merchant::whereId($id)
                            ->update([
                                'name'                      => $request->get('merchant_name'),
                                'phone'                     => $request->get('merchant_phone'),
                                'since'                     => $request->get('year'),
                                'business_type_id'          => $request->get('business_type'),
                                'business_category_id'      => $request->get('business_category'),
                                'status_id'                 => $request->get('status'),
                            ]);

        return redirect()->route('backend.merchants.index')->with('success', 'Successful Updated Merchant!');
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
