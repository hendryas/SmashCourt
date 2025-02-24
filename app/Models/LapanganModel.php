<?php

namespace App\Models;

use CodeIgniter\Model;

class LapanganModel extends Model
{
    protected $table            = 'lapangan';
    protected $primaryKey       = 'lapangan_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'tipe_lantai', 'harga_per_jam', 'fasilitas', 'status', 'delete_sts', 'created_user', 'updated_user'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getAll()
    {
        return $this->where('delete_sts', 0)->findAll();
    }

    public function getLapangan($lapangan_id)
    {
        return $this->where('lapangan_id', $lapangan_id)
            ->where('delete_sts', 0)
            ->first();
    }

    public function getLapanganWithBooked()
    {
        return $this->select('lapangan.*, fieldbookings.booking_status')
            ->join('fieldbookings', 'fieldbookings.lapangan_id = lapangan.lapangan_id', 'left')
            ->where('lapangan.delete_sts', 0)
            ->findAll();
    }

    public function countAllField()
    {
        return $this->where('delete_sts', 0)->countAllResults();
    }
}
