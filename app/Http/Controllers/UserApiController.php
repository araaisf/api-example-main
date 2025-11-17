<?php

namespace App\Http\Controllers;

use App\Models\UserApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserApiController extends Controller
{
    public function index()
    {
        return response()->json(UserApi::with('catatan')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $user = UserApi::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($user, 201);
    }

    public function show($id)
    {
        $user = UserApi::with('catatan')->find($id);
        if (!$user) return response()->json(['message' => 'User tidak ditemukan'], 404);
        return $user;
    }

    public function update(Request $request, $id)
    {
        $user = UserApi::find($id);
        if (!$user) return response()->json(['message' => 'User tidak ditemukan'], 404);

        if ($request->has('password')) {
            $request->merge(['password' => Hash::make($request->password)]);
        }

        $user->update($request->all());
        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = UserApi::find($id);
        if (!$user) return response()->json(['message' => 'User tidak ditemukan'], 404);

        $user->delete();
        return response()->json(['message' => 'User berhasil dihapus']);
    }
}
