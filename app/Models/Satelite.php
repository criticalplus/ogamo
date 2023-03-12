<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Planeta;
use Illuminate\Database\Eloquent\SoftDeletes;

class Satelite extends Model{
    
    use HasFactory, Notifiable, SoftDeletes;
    
    protected $fillable = [
        'planeta_id',
        'nombre',
        'pos',
        'magnitud',
    ];

    protected $hidden = [
        
    ];

    protected $casts = [
    ];

    
    //ELOQUENT

    protected $connection = 'mysql';
    protected $table = 'satelites';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function Planeta(){

        return $this->belongsTo(Planeta::class);
    }


}
