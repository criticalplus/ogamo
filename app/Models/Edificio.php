<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Nivel;

class Edificio extends Model{
    
    use HasFactory, Notifiable;
    
    protected $fillable = [
        'name',
        'photo_path',
        'categoria',
    ];

    protected $hidden = [
        
    ];

    protected $casts = [
    ];

    
    //ELOQUENT

    protected $connection = 'mysql';
    protected $table = 'edificios';
    protected $primaryKey = 'id';
    public $timestamps = false;


    public function Niveles(){

        return $this->hasMany(Nivel::class);
    }



}
