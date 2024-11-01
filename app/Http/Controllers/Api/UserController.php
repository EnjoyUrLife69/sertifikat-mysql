<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        // Mendapatkan semua data User
        $users = User::all();
        return new UserResource(true, 'List Data User', $users);
    }

    public function store(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // hash password sebelum simpan
        ]);

        // Return response
        return response()->json([
            'success' => true,
            'message' => 'User Berhasil Ditambahkan!',
            'data' => $user,
        ], 201);
    }

    public function show($id)
    {
        // Mencari user berdasarkan ID
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User Tidak Ditemukan',
            ], 404);
        }

        // Return single user as a resource
        return new UserResource(true, 'Detail Data User!', $user);
    }

    public function update(Request $request, $id)
    {
        // Mencari user berdasarkan ID
        $user = User::findOrFail($id);

        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id, // memastikan email unik kecuali untuk user ini
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Update user details
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->has('password')) {
            $user->password = bcrypt($request->password); // Update password jika diberikan
        }

        // Simpan perubahan ke database
        $user->save();

        // Return response
        return response()->json([
            'success' => true,
            'message' => 'User Berhasil Diperbarui!',
            'data' => $user,
        ], 200);
    }

    public function destroy($id)
    {
        // Mencari user berdasarkan ID
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User Tidak Ditemukan',
            ], 404);
        }

        // Menghapus user
        $user->delete();

        // Return response
        return response()->json([
            'success' => true,
            'message' => 'User Berhasil Dihapus!',
        ], 200);
    }
}
