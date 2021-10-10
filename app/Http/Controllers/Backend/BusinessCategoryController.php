<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\BusinessCategory;
use App\Http\Controllers\Controller;

class BusinessCategoryController extends Controller
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
        $businessCategory = BusinessCategory::all();

        return view('backend.business-categories.index', [
            'title' => 'Business Category',
            'no' => 1,
            'categories' => $businessCategory,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.business-categories.create', [
            'title' => 'Business Category',
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
            'category_name'     => 'required|min:5|max:200|unique:business_categories,name',
            'category_initial'  => 'nullable|max:10',
        ])->validate();

        $businessCategory = BusinessCategory::create([
            'name'      => ucwords($request->get('category_name')),
            'initial'   => $request->get('category_initial'),
            'slug'      => \Str::slug($request->get('category_name'), '-'),
        ]);

        return redirect()->route('backend.businesses.categories.index')->with('success', 'Successful Added New Business Category!');
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
        $businessCategory = BusinessCategory::findOrFail($id);

        return view('backend.business-categories.edit', [
            'title'     => 'Business Category',
            'category'  => $businessCategory,
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
            'category_name'     => 'required|min:5|max:200',
            'category_initial'  => 'nullable|max:10',
            'status_option'     => 'required|boolean',
        ])->validate();

        $businessCategory = BusinessCategory::findOrFail($id);
        $businessCategory->name     = ucwords($request->get('category_name'));
        $businessCategory->initial  = $request->get('category_initial');
        $businessCategory->status   = $request->get('status_option');
        $businessCategory->save();

        return redirect()->route('backend.businesses.categories.index')->with('success', 'Successful Updated Business Category!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $businessCategory = BusinessCategory::findOrFail($id);
        $businessCategory->delete();

        return redirect()->route('backend.businesses.categories.index')->with('success', 'Successful Deleted Business Category!');
    }
}
