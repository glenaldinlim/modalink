<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('role:webmaster|bod');
        $this->middleware('auth')->except(['edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::role(['bod', 'webmaster', 'admin'])->get();

        return view('backend.users.index', [
            'no'    => 1,
            'title' => 'Manage HR',
            'users' => $users, 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create', [
            'title' => 'Manage HR'
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
            'name'     => 'required|max:100',
            'email'    => 'required|email|unique:users',
            'phone'    => 'required|regex:/^[0-9]*$/|max:20',
            'role'     => 'required',
        ])->validate();

        $user = User::create([
            'name'      => ucwords($request->get('name')),
            'email'     => $request->get('email'),
            'phone'     => $request->get('phone'),
            'password'  => bcrypt('moda.link00')
        ]);
        $user->assignRole($request->get('role'));

        return redirect()->route('backend.users.index')->with('success', 'Successful Added New Administrator!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (\Auth::user()->id == $id) {
            $user = User::findOrFail($id);

            return view('backend.users.profile.index', [
                'title' => 'Profile',
                'user'  => $user,
            ]);
        }
        
        return abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('backend.users.edit', [
            'title' => 'Manage HR',
            'user'  => $user,
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
        if (\Auth::user()->id != $id) {
            $validation = \Validator::make($request->all(), [
                'role'     => 'required',
            ])->validate();
    
            $user = User::findOrFail($id);
            $user->syncRoles($request->get('role'));
    
            return redirect()->route('backend.users.index')->with('success', 'Successful Updated '.$user->name.' Role');
        }

        return abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (\Auth::user()->id != $id) {
            $user = User::findOrFail($id);
            $user->delete();

            UserActivity::create([
                'user_id'       => \Auth::user()->id,
                'description'   => 'Deleted Administrator '.$user->fullname
            ]);

            return redirect()->route('admins.index')->with('success', 'Successful Deleted Administrator!');
        }

        return abort(403);
    }

    public function updateEmail(Request $request, $id)
    {
        $validation = \Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
        ])->validate();

        $user = User::findOrFail($id);
        $user->email = $request->get('email');
        $user->save();

        return redirect()->route('backend.users.show', ['id' => $id])->with('success', 'Successful Updated Email');
    }

    public function updatePassword(Request $request, $id)
    {
        $validation = \Validator::make($request->all(), [
            'password'              => 'required|min:8|max:16',
            'password_confirmation' => 'required|same:password',
        ])->validate();

        $user = User::findOrFail($id);
        $user->password = \Hash::make($request->get('password'));
        $user->save();

        return redirect()->route('backend.users.show', ['id' => $id])->with('success', 'Successful Updated Password');
    }

    public function updateProfile(Request $request, $id)
    {
        $validation = \Validator::make($request->all(), [
            'name'      => 'required|max:50',
            'phone'     => 'required|regex:/^[0-9]*$/|max:20',
            'avatar'    => 'nullable|mimes:jpg,png,jpeg|max:3072'
        ])->validate();

        $user = User::findOrFail($id);
        $user->name = $request->get('name');
        $user->phone = $request->get('phone');
        if ($request->file('avatar')) {
            $path = $request->file('avatar')->store('users', 'public');
            $user->avatar = $path;
        }
        $user->save();

        return redirect()->route('backend.users.show', ['id' => $id ])->with('success', 'Successful Update Profile');
    }
}
