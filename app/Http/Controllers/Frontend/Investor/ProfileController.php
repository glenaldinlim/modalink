<?php

namespace App\Http\Controllers\Frontend\Investor;

use App\Models\Bank;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserCredential;
use App\Models\UserBankAccount;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::with(['userCredential', 'userBankAccount'])->whereId(\Auth::user()->id)->first();
        $banks = Bank::whereStatus(1)->get();

        return view('frontend.investors.profiles.index', [
            'title' => 'Profiles',
            'user' => $user,
            'banks' => $banks,
        ]);
    }

    public function updateBiodata(Request $request, $id)
    {
        $validation = \Validator::make($request->all(), [
            'name'      => 'required|max:200|regex:/^[A-Za-z ]*$/',
            'phone'     => 'required|regex:/^[0-9]*$/|max:20',
            'job'       => 'required|max:200|regex:/^[A-Za-z ]*$/',
            'birthdate' => 'required|date',
            'gender'    => 'required|regex:/^[MF]*$/'
        ])->validate();

        $user = User::whereId($id)
                    ->update([
                        'name'      => $request->get('name'),
                        'phone'     => $request->get('phone'),
                        'gender'    => $request->get('gender'),
                    ]);

        $userCredential = UserCredential::where('user_id', $id)
                                        ->update([
                                            'job'       => $request->get('job'),
                                            'birthdate' => $request->get('birthdate'),
                                        ]);

        return redirect()->route('front.investor.profiles.index')->with('success', 'Berhasil mengubah data diri');
    }

    public function updateBank(Request $request, $id)
    {
        $validation = \Validator::make($request->all(), [
            'bank'              => 'required|numeric',
            'account_number'    => 'required|numeric|digits_between:3,50',
            'alias_name'        => 'required|min:3|max:200|regex:/^[A-Za-z ]*$/',
        ])->validate();

        $userBankAccount = UserBankAccount::where('user_id', $id)->update([
            'bank_id'           => $request->get('bank'),
            'branch'            => $request->get('branch'),
            'account_number'    => $request->get('account_number'),
            'alias_name'        => $request->get('alias_name'),
        ]);

        return redirect()->route('front.investor.profiles.index')->with('success', 'Berhasil mengubah informasi rekening');
    }

    public function updateSetting(Request $request, $id)
    {
        $validation = \Validator::make($request->all(), [
            'old_password'              => 'required|min:8|max:16',
            'new_password'              => 'required|min:8|max:16',
            'new_password_confirmation' => 'required|same:new_password',
        ])->validate();

        $user = User::findOrFail($id);
        if (\Hash::check($request->get('old_password'), $user->password)) {
            $user->password = \Hash::make($request->get('password'));
            $user->save();

            return redirect()->route('front.investor.profiles.index')->with('success', 'Berhasil mengubah kata sandi');
        } else {
            return redirect()->route('front.investor.profiles.index')->with('danger', 'Kata sandi lama tidak cocok!');
        }
    }
}
