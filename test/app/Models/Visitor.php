<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    
    protected $table = 'visitor_count';
    
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'ip', 'date_visited'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id' , 'id');
    }
}
