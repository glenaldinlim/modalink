<?php

namespace App\Http\Controllers\Backend;

use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = Status::all();
        
        return view('backend.statuses.index', [
            'title'     => 'Status',
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
        return view('backend.statuses.create', [
            'title' => 'Status',
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

        $status = Status::create([
            'name'        => ucwords($request->get('status_state')),
            'description' => $request->get('description'),
        ]);

        return redirect()->route('backend.statuses.index')->with('success', 'Successful Added New Status!');
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
        $status = Status::findOrFail($id);

        return view('backend.statuses.edit', [
            'title'     => 'Status',
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

        $status               = Status::findOrFail($id);
        $status->name         = ucwords($request->get('status_state'));
        $status->description  = $request->get('description');
        $status->save();

        return redirect()->route('backend.statuses.index')->with('success', 'Successful Updated Status!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = Status::findOrFail($id);
        $status->delete();

        return redirect()->route('backend.statuses.index')->with('success', 'Successful Deleted Status!');
    }
}
