<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->fill([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => $request['password'] ? Hash::make($request['password']) : $user->password,
            'admin' => $request['admin'],
        ]);

        // 変更がなかった場合は戻る
        if (!$user->isDirty()) {
            session()->flash('notice', '変更がありません');
            return back();
        }

        // emailの変更時は検証メールを送信
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
            event(new Registered($user));
        }

        $user->save();
        session()->flash('notice', 'ユーザー情報を更新しました。');

        return redirect()->route('users.edit', $user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
