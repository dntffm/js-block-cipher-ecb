<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class paket_pekerjaan extends Model
{
  protected $table = 'paket_pekerjaan';
  protected $fillable= ['foto_paket', 'nama_paket', 'deskripsi_paket', 'harga_paket'];

  public function getPhoto(){
    if(!$this->foto_paket){
      return asset('/images/img_2.jpg');
    }
    return asset('images/'.$this->foto_paket);
  }

  public function getharga()
  {
    return money_format('Rp%i', $this->harga_paket);
  }

  public function masters()
    {
        return $this->hasOne(user::class);
    }
    public function master()
    {
        return $this->belongsTo(master::class, 'user_id');
    }
}
