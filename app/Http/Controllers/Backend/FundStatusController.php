<?php

namespace App\Http\Controllers\Backend;

use App\Models\FundStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FundStatusController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('role:webmaster|admin');
        $this->middleware('auth')->except(['create', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = FundStatus::all();
        
        return view('backend.fund-statuses.index', [
            'title'     => 'Fund Status',
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
        return view('backend.fund-statuses.create', [
            'title' => 'Fund Status',
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

        $status = FundStatus::create([
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
        $status = FundStatus::findOrFail($id);

        return view('backend.fund-statuses.edit', [
            'title'     => 'Fund Status',
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

        $status               = FundStatus::findOrFail($id);
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
