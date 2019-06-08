<?php

namespace App\Http\Controllers;

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

        if ('active' == $type) {
            Mail::to('elktrgtr@gmail.com')->send(new NewsletterActive($url));
        }
        if ('inactive' == $type) {
            Mail::to('elktrgtr@gmail.com')->send(new NewsletterInactive($url));
        }

        return view('form');
    }
}
