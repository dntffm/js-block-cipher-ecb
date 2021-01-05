<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pembayaran extends Model
{

    protected $table = 'pembayaran';
    protected $fillable= ['bukti_transfer', 'id_statuspembayaran', 'day_start','day_over', 'kode_pembayaran','id_order'];

     public function getbukti()
     {
     	if(!$this->bukti_transfer){
     		'no foto';
     	}
     	return asset('images/'.$this->bukti_transfer);
     }

     public function order_art()
    {
        return $this->belongsto(m_order_paket::class, 'id_order');
    }
    public function statuspembayaran()
    {
        return $this->belongsto(statuspembayaran::class, 'id_statuspembayaran');
    }
}
