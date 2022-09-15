<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
    'tool', 'tool_type', 'file_attached', 
    'file_type', 'name', 'email', 
    'phone', 'model_year', 'license_plate', 
    'vin_number', 'brand', 'model','version', 
    'tools', 'gear_box'];
}
