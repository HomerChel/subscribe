<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Mail\NewsletterActive;
use App\Mail\NewsletterInactive;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    /**
     * Show send form.
     *
     * @return View
     */
    public function form()
    {
        return view('form');
    }

    /**
     * Send email.
     *
     * @param  Request  $request
     * @return View
     */
    public function sendEmail(Request $request)
    {
        $type = $request->input('type');
        $url = $request->input('url');
        $users = User::where('subscr_status', $type)->get();
        $count = $users->count();

        foreach ($users as $user) {
            if ('active' == $type) {
                Mail::to($user->email)->send(new NewsletterActive($url, $user->name));
            }
            if ('inactive' == $type) {
                Mail::to($user->email)->send(new NewsletterInactive($url, $user->name));
            }
        }

        return view('form', [
            'type' => $type,
            'url' => $url,
            'count' => $count
        ]);
    }
}
