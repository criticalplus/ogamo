<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\UserData;
use App\Models\Galaxia;
use Illuminate\Database\Eloquent\SoftDeletes;

class Universo extends Model{
    
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'photo_path'
    ];

    protected $hidden = [
        
    ];

    protected $casts = [
    ];

    
    //ELOQUENT

    protected $connection = 'mysql';
    protected $table = 'universos';
    protected $primaryKey = 'id';
    public $timestamps = true;


    public function UserData(){

        return $this->hasOne(UserData::class);
    }

    public function Galaxia(){

        return $this->hasOne(Galaxia::class);
    }



}
