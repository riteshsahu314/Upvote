<?php

namespace App\Http\Controllers;

use App\Filters\UserFilter;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(UserFilter $filter)
    {
        $users = User::filter($filter)->paginate(30);

        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }
}
