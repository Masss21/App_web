<?php

namespace App\Models;
use CodeIgniter\Model;

class ServisModel extends Model
{
    protected $table = 'servis';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_kendaraan', 'tanggal_servis', 'jenis_servis', 'biaya'];
}
