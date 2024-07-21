<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function Klinik()
    {
        return $this->belongsTo(Klinik::class, 'klinik_id', 'id');
    }
    public function Service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
    public function Pasien()
    {
        return $this->belongsTo(User::class, 'pasien_id', 'id');
    }
    public function Petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id', 'id');
    }
    public function Dokter()
    {
        return $this->belongsTo(User::class, 'dokter_id', 'id');
    }
}
