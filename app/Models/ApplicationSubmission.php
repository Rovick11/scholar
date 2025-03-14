<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ApplicationSubmission extends Model
{
 

    protected $fillable = ['user_id','COR', 'indigencyCertificate', 'gradesForm', 'status'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
