<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $req)
    {
        $input = $req->all();

        $this->validate($req, [
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['username' => $input['username'], 'password' => $input['password']])) {
            return redirect()->route('home');
        }

        return redirect()->back();
    }

    protected function guard()
    {
        return Auth::guard();
    }

    protected function loggedOut(Request $request)
    {
        //
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }

    // CRUD
    public function update(Request $request, $user_id)
    {
        $user = User::find($user_id);
        if ($user && $request->username != null && $request->name != null) {
            $user->username = $request->username;
            $user->name = $request->name;
            if ($request->password != null) {
                $user->password = bcrypt($request->password);
            }
            $user->save();
            return redirect()->back()->with('message', 'Berhasil memperbarui data user');
        }
        return redirect()->back()->with('error', 'Gagal memperbarui data user');
    }
    public function store(Request $request)
    {
        $user = new User();
        if ($user && $request->username != null && $request->name != null && $request->password != null) {
            $user->username = $request->username;
            $user->name = $request->name;
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect()->back()->with('message', 'Berhasil menambahkan data user');
        } 
        return redirect()->back()->with('error', 'Gagal menambahkan data user');
    }
}
