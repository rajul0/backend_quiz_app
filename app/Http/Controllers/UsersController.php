<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class UsersController extends Controller
{
    public function index()
    {
        $data = Users::all();
        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $user = Users::create($request->all());
        return response()->json($user, 201);
    }

    public function show($id)
    {
        return Users::find($id);
    }

    public function update(Request $request, $id)
    {
        $user = Users::findOrFail($id);
        $user->update($request->all());
        return response()->json($user, 200);
    }

    public function destroy($id)
    {
        Users::destroy($id);
        return response()->json(null, 204);
    }
}
