<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Sistema;
use App\Models\User;
use App\Models\Satelite;
use App\Models\Recurso;
use App\Models\Nivel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Planeta extends Model{
    
    use HasFactory, Notifiable, SoftDeletes;
    
    protected $fillable = [
        'universo_id',
        'sistema_id',
        'user_id',
        'nombre',
        'pos',
        'habitable',
        'atmosfera',
        'tipo',
        'bioma',
        'magnitud',
    ];

    protected $hidden = [
        
    ];

    protected $casts = [
    ];

    
    //ELOQUENT

    protected $connection = 'mysql';
    protected $table = 'planetas';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function Sistema(){

        return $this->belongsTo(Sistema::class);
    }

    public function User(){

        return $this->belongsTo(User::class);
    }

    public function Satelites(){

        return $this->hasMany(Satelite::class);
    }

    public function Recursos(){

        return $this->belongsToMany(Recurso::class, 'planeta_recursos')->withPivot('cantidad');
    }

    public function Niveles(){

        return $this->belongsToMany(Nivel::class, 'planeta_niveles')->withPivot('fin');
    }



}
