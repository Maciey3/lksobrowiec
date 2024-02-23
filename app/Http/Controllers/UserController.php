<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Alert\Alert;
use App\Models\User;


class UserController extends Controller
{
    public function index(){
        $users = User::paginate(10);
        
        return view('admin.user.users', ['users' => $users]);
    }

    public function show($id){
        $users = User::paginate(10);
        
        return view('admin.user.users', ['users' => $users]);
    }

    public function create(){
        return view('admin.user.create');
    }

    public function store(CreateUserRequest $request){
        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // Auth::login($user);
        $alert = new Alert('success');
        $alert->use();
        return redirect(route('user.index'));
    }
}
