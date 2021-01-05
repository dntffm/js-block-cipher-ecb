<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class master extends User
{
   

    protected $table = 'master';
    protected $fillable= [ 'foto', 'name', 'nohp', 'kecamatan', 'alamat',
    'kodepos', 'user_id'];
  

    public function getPhoto(){
        if(!$this->foto){
            return asset('images/default.png');
        }
        return asset('images/'.$this->foto);
    }


    public function User()
    {
        return $this->belongsTo(User::class);
    }

     public function Users()
    {
        return $this->hasOne(User::class);
    }
   

}
