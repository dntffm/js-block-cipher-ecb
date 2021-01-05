<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class m_bank extends Model
{
     protected $table = 'bank';
    protected $fillable= ['bank', 'no_rekening', 'nama'];

     public function paket()
    {
        return $this->belongsTo(paket_pekerjaan::class);
    }
     public function order()
    {
        return $this->belongsTo(m_order_data::class);
    }
}
