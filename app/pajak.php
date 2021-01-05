<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pajak extends Model
{
     protected $table = 'pajak';
    protected $fillable= [ 'pajak', 'ongkir'];
     public function paket()
    {
        return $this->belongsTo(paket_pekerjaan::class);
    }
     public function order()
    {
        return $this->belongsTo(m_order_data::class);
    }
}
