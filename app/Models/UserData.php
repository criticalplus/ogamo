<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\User;
use App\Models\Universo;

class UserData extends Model{
    
    use HasFactory, Notifiable;
    
    protected $fillable = [
        'user_id',
        'universo_id',
        'role'
    ];

    protected $hidden = [
        
    ];

    protected $casts = [
    ];

    
    //ELOQUENT

    protected $connection = 'mysql';
    protected $table = 'users_data';
    protected $primaryKey = 'id';
    public $timestamps = false;


    public function user(){

        return $this->belongsTo(User::class);
    }

    public function universo(){

        return $this->belongsTo(Universo::class);
    }




}
