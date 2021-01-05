<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class m_review extends Model
{
    protected $table = 'review';
    protected $fillable= ['order_id','foto','review','rating','id_art'];

    public function order()
    {
        return $this->belongsTo(m_order_paket::class, 'order_id');
    }
    public function orders()
    {
        return $this->hasMany(m_order_paket::class, 'order_id');
    }
     public function art()
    {
        return $this->belongsTo(art::class);
    }
     public function getPhoto(){
        if(!$this->foto){
            return asset('images/default.png');
        }
        return asset('images/'.$this->foto);
    }
}
