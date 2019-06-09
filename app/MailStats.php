<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailStats extends Model
{
    protected $fillable = ['email', 'subscr_status', 'url'];
}
