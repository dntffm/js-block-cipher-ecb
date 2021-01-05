<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;
class m_order_paket extends Model
{
	use SoftDeletes;
    protected $date = ['deleted_at'];
     protected $table = 'order_art';
//      protected $casts = [
//     'created_at', 'updated_at'
// ];

    protected $fillable = ['id_art', 'id_master','id_paket','id_status_penerimaan','id_bank','nomor_order', 'waktu_kerja','mp','total'];

    public function master()
    {
        return $this->hasMany(master::class, 'id_master', 'user_id');
    }
    public function masters()
    {
        return $this->belongsto(master::class, 'id_master', 'user_id');
    }
    public function orders()
    {
        return $this->hasOne(m_order_paket::class, 'order_id');
    }

    public function arts()
    {
        return $this->hasMany(art::class, 'id_art');
    }
    public function art()
    {
        return $this->belongsto(art::class, 'id_art','user_id');
    }
     public function paket(){
        return $this->hasOne(paket_pekerjaan::class);
    }
    
    public function getFormattedDateAttribute()
    {
    return Carbon::createFromFormat($this->created_at)->format('m');
    }

}
