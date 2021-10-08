<?php

namespace App\Http\Controllers\Backend;

use App\Models\BusinessType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BusinessTypeController extends Controller
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
        $businessTypes = BusinessType::all();

        return view('backend.business-types.index', [
            'title' => 'Business Type',
            'no'    => 1,
            'types' => $businessTypes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.business-types.create', [
            'title' => 'Bussines Type'
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

        $type = BusinessType::create([
            'name' => ucwords($request->get('type_name')),
        ]);

        return redirect()->route('backend.businesses.types.index')->with('success', 'Successful Added New Business Type!');
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
        $businessTypes = BusinessType::findOrFail($id);

        return view('backend.business-types.edit', [
            'title' => 'Business Type',
            'type'  => $businessTypes,
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

        $type = BusinessType::findOrFail($id);
        $type->name   = ucwords($request->get('type_name'));
        $type->status = $request->get('status_option');
        $type->save();

        return redirect()->route('backend.businesses.types.index')->with('success', 'Successful Updated Business Type!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $businessType = BusinessType::findOrFail($id);
        $businessType->delete();

        return redirect()->route('backend.businesses.types.index')->with('success', 'Successful Deleted Business Type!');
    }
}
