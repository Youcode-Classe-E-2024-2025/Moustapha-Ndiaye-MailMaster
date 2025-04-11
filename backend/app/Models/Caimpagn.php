<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caimpagn extends Model
{
    protected $fillable = [
        'subject',
        'sent_at',
        'newsletter_id',
    ];    
}
