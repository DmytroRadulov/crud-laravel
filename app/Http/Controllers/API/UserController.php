<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController
{
    public function ListUser()
    {

        return User::all();

    }

    public function createToken(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:5'],
            'device_name' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages('Невалідні дані!');
        }

        return $user->createToken($request->device_name)->plainTextToken;
    }

    public function logout(Request $request)
    {
        return $request->user()->currentAccessToken()->delete();
    }


    public function create()
    {
        $user = new User();
        return view('user/form', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'unique:name',
                'min:4',
                'max:8',
            ],
            'email' => [
                'required',
                'unique:email',
            ]
        ]);

        User::create($request->all());
        return redirect()->route('user');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('user/form', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::find($request->input('id'));
        $request->validate([
            'name' => [
                'required',
                'min:3',
                'max:10',
                Rule::unique('users', 'name',)->ignore($user->id),
            ],
            'email' => ['required',
                Rule::unique('users', 'email',)->ignore($user->id),
            ],
            'country_id' => ['exists:countries,id'],
        ]);
        $user->update($request->all());
        return redirect()->route('user');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user');
    }
}
