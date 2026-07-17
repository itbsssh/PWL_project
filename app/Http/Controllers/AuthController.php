<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    //Register
    public function register(Request $request)
    {
        // 1. Definisikan aturan validasi dasar
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string'
        ];

        // 2. Buat validator dasar
        $validator = Validator::make($request->all(), $rules);

        // 3. Tambahkan validasi kustom secara manual untuk Kunci Admin jika role-nya 'admin'
        $validator->after(function ($validator) use ($request) {
            if ($request->get('role') === 'admin') {
                if ($request->get('admin_key') !== 'Admin-24210030') {
                    $validator->errors()->add('admin_key', 'Kode Kunci Admin salah atau belum diisi!');
                }
            }
        });

        // 4. Jika ada validasi yang gagal (baik password < 6, maupun kunci admin salah)
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        // 5. Jika sukses, simpan user baru
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'role' => $request->get('role'),
        ]);

        return redirect(route('login'));
    }

    // User login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = Auth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }

            // Get the authenticated user.
            $user = Auth::user();

            // (optional) Attach the role to the token.
            // $token = Auth::claims(['role' => $user->role])->fromUser($user);
            
            return redirect(route('dashboard'), 302, ['Authorization' => 'Bearer ' . $token]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }
    }

    //Register Form
    public function registerView(Request $request)
    {
        return view('register');
    }

    // Login Form
    public function loginView(Request $request)
    {
        return view('login');
    }
    public function logout(Request $request)
    {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('dashboard');
}
}