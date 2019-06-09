<?php

namespace App\Mail;

use App\MailStats;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewsletterActive extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Url for button.
     *
     * @var string
     */
    public $url;

    /**
     * User's name.
     *
     * @var string
     */
    public $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($url, $name)
    {
        $this->url = $url;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $stat = new MailStats;
        $stat->fill([
            'email' => $this->to[0]['address'],
            'subscr_status' => 'active',
            'url' => $this->url
        ]);
        $stat->save();

        return $this->markdown('mail.subscription.active');
    }
}
