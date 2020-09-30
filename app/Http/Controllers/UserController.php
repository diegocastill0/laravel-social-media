<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Friendship;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        $friendshipStatus = optional(Friendship::where([
            'recipient_id' => $user->id,
            'sender_id' => auth()->id()
        ])->first())->status;
            
        return view('users.show', compact('user', 'friendshipStatus'));
    }
}
