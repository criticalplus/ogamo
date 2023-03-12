<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Galaxia;
use App\Models\Planeta;

class Sistema extends Model{
    
    use HasFactory, Notifiable;
    
    protected $fillable = [
        'galaxia_id',
        'posY',
        'posZ',
        'num_planetas',
        'num_estrellas',
        'tipo_estrellas'
    ];

    protected $hidden = [
        
    ];

    protected $casts = [
    ];

    
    //ELOQUENT

    protected $connection = 'mysql';
    protected $table = 'sistemas';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function Galaxia(){

        return $this->belongsTo(Galaxia::class);
    }

    public function Planetas(){

        return $this->hasMany(Planeta::class);
    }



}
