<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function register(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required',
            'password' => 'required|min:8|max:255'
        ], [
            'name.required' => 'Nama harus diisi',
            'name.min' => 'Nama harus memiliki minimal 3 karakter',

            'email.required' => 'Email harus diisi',

            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal memili minimal 8 karakter'
        ]);

        $validateData['password'] = Hash::make($validateData['password']);

        User::create($validateData);

        return redirect('/login')->with('success', 'Akun Berhasil Dibuat');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            $request->session()->put('user', $user);

            return redirect()->route('halaman-home')->with('success', 'You Have Logged In');
        }

        return back()->with('loginError', 'Oops You Might Entered Wrong Email or Password');
    }


    public function halamanIndex(Request $request)
    {
        $postingan = Post::with('user')->orderBy('created_at', 'desc')->get();

        return view('index', [
            'postingan' => $postingan
        ]);
    }



    public function halamanHome(Request $request)
    {
        $postingan = Post::with('user')->orderBy('created_at', 'desc')->get();
        $user = $request->session()->get('user');

        return view('home', [
            'success' => session('success'),
            'user' => $user,
            'postingan' => $postingan
        ]);
    }





    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
