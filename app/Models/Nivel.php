<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Recurso;
use App\Models\Edificio;

class Nivel extends Model{
    
    use HasFactory, Notifiable;
    
    protected $fillable = [
        'nivel',
        'tiempo',
    ];

    protected $hidden = [
        
    ];

    protected $casts = [
    ];

    
    //ELOQUENT

    protected $connection = 'mysql';
    protected $table = 'niveles';
    protected $primaryKey = 'id';
    public $timestamps = false;


    public function Recursos(){

        return $this->belongsToMany(Recurso::class, 'niveles_recursos')->withPivot('coste', 'consumo', 'produccion');
    }

    public function Edificios(){

        return $this->belongsTo(Edificio::class, 'edificio_id');
    }

    public function Planetas(){

        return $this->belongsToMany(Planeta::class, 'planeta_niveles')->withPivot('fin');
    }



}
