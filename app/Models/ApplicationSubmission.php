<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ApplicationSubmission extends Model
{
 

    protected $fillable = ['user_id','COR', 'indigency Certificate', 'gradesForm'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
