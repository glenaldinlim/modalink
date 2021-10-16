<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchaseStatus extends Controller
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
        $statuses = PurchaseStatus::all();
        
        return view('backend.purchase-statuses.index', [
            'title'     => 'Purchase Status',
            'no'        => 1,
            'statuses'  => $statuses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.purchase-statuses.create', [
            'title' => 'Purchase Status',
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
            'status_state'  => 'required|min:5|max:200',
            'description'   => 'nullable|max:255',
        ])->validate();

        $status = PurchaseStatus::create([
            'name'        => ucwords($request->get('status_state')),
            'description' => $request->get('description'),
        ]);

        return redirect()->route('backend.funds.statuses.index')->with('success', 'Successful Added New Verification Status!');
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
        $status = PurchaseStatus::findOrFail($id);

        return view('backend.purchase-statuses.edit', [
            'title'     => 'Purchase Status',
            'status'    => $status,
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
            'status_state'  => 'required|min:5|max:200',
            'description'   => 'nullable|max:255',
        ])->validate();

        $status               = PurchaseStatus::findOrFail($id);
        $status->name         = ucwords($request->get('status_state'));
        $status->description  = $request->get('description');
        $status->save();

        return redirect()->route('backend.funds.statuses.index')->with('success', 'Successful Updated Verification Status!');
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
