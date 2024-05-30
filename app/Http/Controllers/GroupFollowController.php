<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\GroupFollower;
use Illuminate\Support\Facades\Auth;

class GroupFollowController extends Controller
{
    public function follow(Group $group)
    {
        $user = Auth::user();
        $group->followers()->create(['user_id' => $user->id]);

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Ahora sigues al grupo ' . $group->name]);
        }

        return back()->with('success', 'Ahora sigues al grupo ' . $group->name);
    }

    public function unfollow(Group $group)
    {
        $user = Auth::user();
        $groupFollower = GroupFollower::where('group_id', $group->id)->where('user_id', $user->id)->first();

        if ($groupFollower) {
            $groupFollower->delete();
            if (request()->ajax()) {
                return response()->json(['success' => true, 'message' => 'Has dejado de seguir al grupo ' . $group->name]);
            }
            return back()->with('success', 'Has dejado de seguir al grupo ' . $group->name);
        } else {
            if (request()->ajax()) {
                return response()->json(['error' => true, 'message' => 'No estabas siguiendo al grupo ' . $group->name]);
            }
            return back()->with('error', 'No estabas siguiendo al grupo ' . $group->name);
        }
    }
}
