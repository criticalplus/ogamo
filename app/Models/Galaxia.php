<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Universo;
use App\Models\Sistema;

class Galaxia extends Model{
    
    use HasFactory, Notifiable;
    
    protected $fillable = [
        'universo_id',
        'posY',
        'posZ',
        'tipo'
    ];

    protected $hidden = [
        
    ];

    protected $casts = [
    ];

    
    //ELOQUENT

    protected $connection = 'mysql';
    protected $table = 'galaxias';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function Universo(){

        return $this->belongsTo(Universo::class);
    }

    public function Sistemas(){

        return $this->hasMany(Sistema::class);
    }



}
