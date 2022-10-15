<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;
    protected $fillable = ['credits','price_payed', 'stripe_id', 'user_id'];

    public function file(){
        return $this->belongsTo(File::class);
    }
}
