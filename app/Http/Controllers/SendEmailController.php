<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SendEmailController extends Controller
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
        echo "<pre>";
        print_r($request->input('type'));
        print_r($request->input('url'));
        echo "</pre>";
        return view('form');
    }
}
