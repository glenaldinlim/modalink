<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\VerificationStatus;
use App\Http\Controllers\Controller;

class VerificationStatusController extends Controller
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
        $statuses = VerificationStatus::all();
        
        return view('backend.verification-statuses.index', [
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
        return view('backend.verification-statuses.create', [
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

        $status = VerificationStatus::create([
            'name'        => ucwords($request->get('status_state')),
            'description' => $request->get('description'),
        ]);

        return redirect()->route('backend.verification.statuses.index')->with('success', 'Successful Added New Verification Status!');
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
        $status = VerificationStatus::findOrFail($id);

        return view('backend.verification-statuses.edit', [
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

        $status               = VerificationStatus::findOrFail($id);
        $status->name         = ucwords($request->get('status_state'));
        $status->description  = $request->get('description');
        $status->save();

        return redirect()->route('backend.verification.statuses.index')->with('success', 'Successful Updated Verification Status!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = VerificationStatus::findOrFail($id);
        $status->delete();

        return redirect()->route('backend.verification.statuses.index')->with('success', 'Successful Deleted Verification Status!');
    }
}
