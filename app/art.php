<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class art extends User
{
    protected $table = 'art';
    protected $fillable= ['user_id', 'foto', 'name', 'nohp', 'tanggallahir', 'kecamatan', 'alamat',
    'kodepos', 'status', 'deskripsi'];
 
    public function getPhoto(){
    	if(!$this->foto){
    		return asset('/images/default.png');
    	}
    	return asset('images/'.$this->foto);
    }

    public function Users()
    {
        return $this->hasOne(User::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
         public function arts()
    {
        return $this->hasMany(master::class, 'id_art');
    }
}
