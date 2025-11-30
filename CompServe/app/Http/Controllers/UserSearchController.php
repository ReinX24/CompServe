<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserSearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return response()->json([]);
        }

        $users = User::where('name', 'like', "%{$query}%")
            ->where('id', '<>', auth()->id()) // exclude self
            ->limit(10)
            ->get();

        return response()->json($users);
    }
}
