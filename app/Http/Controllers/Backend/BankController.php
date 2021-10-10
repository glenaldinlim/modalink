<?php

namespace App\Http\Controllers\Backend;

use App\Models\Bank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BankController extends Controller
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
        $banks = Bank::all();

        return view('backend.banks.index', [
            'title' => 'Bank',
            'no'    => 1,
            'banks' => $banks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.banks.create', [
            'title' => 'Bank',
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
            'bank_name' => 'required|min:2|max:200',
            'bank_logo' => 'required|image|max:2048',
        ])->validate();

        $path = $request->file('bank_logo')->store('banks', 'public');

        $bank = Bank::create([
            'name' => $request->get('bank_name'),
            'logo' => $path,
        ]);

        return redirect()->route('backend.banks.index')->with('success', 'Successful Added New Bank!');
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
        $bank = Bank::findOrFail($id);

        return view('backend.banks.edit', [
            'title' => 'Bank',
            'bank'  => $bank,
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
            'bank_name'         => 'required|min:2|max:200',
            'bank_logo'         => 'nullable|image|max:2048',
            'status_option'     => 'required|boolean',
        ])->validate();

        $bank = Bank::findOrFail($id);
        $bank->name     = $request->get('bank_name');
        if ($request->file('bank_logo')) {
            $path       = $request->file('bank_logo')->store('banks', 'public');
            $bank->logo = $path;
        }
        $bank->status   = $request->get('status_option');
        $bank->save();

        return redirect()->route('backend.banks.index')->with('success', 'Successful Updated Banks!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Bank = Bank::findOrFail($id);
        $bank->delete();

        return redirect()->route('backend.banks.index')->with('success', 'Successful Deleted Bank!');
    }
}
