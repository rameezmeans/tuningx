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
    'tools', 'gear_box', 'ecu', 'engine', 'credits', 'status', 'is_credited'];

    public function files(){
        return $this->hasMany(RequestFile::class); 
    }

    public function engineer_file_notes(){
        return $this->hasMany(EngineerFileNote::class); 
    }

    public function file_internel_events(){
        return $this->hasMany(FileInternalEvent::class);
    }

    public function file_urls(){
        return $this->hasMany(FileUrl::class);
    }
}
