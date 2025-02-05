<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;
    protected $fillable = ['fname','lname','email'];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
