<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Planeta;
use App\Models\Nivel;

class Recurso extends Model{
    
    use HasFactory, Notifiable;
    
    protected $fillable = [
        'name',
        'photo_path',
    ];

    protected $hidden = [
        
    ];

    protected $casts = [
    ];

    
    //ELOQUENT

    protected $connection = 'mysql';
    protected $table = 'recursos';
    protected $primaryKey = 'id';
    public $timestamps = false;


    public function Planetas(){

        return $this->belongsToMany(Planeta::class, 'planeta_recursos')->withPivot('cantidad');
    }

    public function Niveles(){

        return $this->belongsToMany(Nivel::class, 'niveles_recursos')->withPivot('coste', 'consumo', 'produccion');
    }



}
