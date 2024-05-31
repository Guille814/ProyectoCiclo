<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserSocialLinkController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'spotify_url' => 'nullable|url',
            'soundcloud_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'apple_music_url' => 'nullable|url',
        ]);

        $user = auth()->user();
        $user->update($request->all());

        foreach ($request->social_links as $network => $url) {
            $user->socialLinks()->updateOrCreate(
                ['social_network' => $network],
                ['url' => $url]
            );
        }

        return back()->with('success', 'Profile updated successfully!');
    }
}
