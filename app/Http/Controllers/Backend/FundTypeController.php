<?php

namespace App\Http\Controllers\Backend;

use App\Models\FundType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FundTypeController extends Controller
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
        $fundTypes = FundType::all();

        return view('backend.fund-types.index', [
            'title' => 'Fund Type',
            'no'    => 1,
            'types' => $fundTypes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.fund-types.create', [
            'title' => 'Fund Type'
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
            'type_name' => 'required|min:5|max:200',
        ])->validate();

        $type = FundType::create([
            'name' => ucwords($request->get('type_name')),
        ]);

        return redirect()->route('backend.funds.types.index')->with('success', 'Successful Added New Fund Type!');
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
        $fundTypes = FundType::findOrFail($id);

        return view('backend.fund-types.edit', [
            'title' => 'Fund Type',
            'type'  => $fundTypes,
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
            'type_name'     => 'required|min:5|max:200',
            'status_option' => 'required|boolean',
        ])->validate();

        $type = FundType::findOrFail($id);
        $type->name   = ucwords($request->get('type_name'));
        $type->status = $request->get('status_option');
        $type->save();

        return redirect()->route('backend.funds.types.index')->with('success', 'Successful Updated Fund Type!');
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
