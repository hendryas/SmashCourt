<?php

namespace App\Models;

use CodeIgniter\Model;

class FieldBookingModel extends Model
{
    protected $table            = 'fieldbookings';
    protected $primaryKey       = 'booking_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['lapangan_id', 'nama_customer', 'nomor_telefon_customer', 'email_customer', 'booking_date', 'start_time', 'end_time', 'total_price', 'payment_method', 'payment_status', 'booking_status', 'bukti_transfer'];

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
        return $this->findAll();
    }

    public function getBooking($booking_id)
    {
        return $this->where('booking_id', $booking_id)
            ->where('delete_sts', 0)
            ->first();
    }

    public function getBookingWithLapangan()
    {
        return $this->select('fieldbookings.*, lapangan.nama')
            ->join('lapangan', 'lapangan.lapangan_id = fieldbookings.lapangan_id', 'left')
            ->where('lapangan.delete_sts', 0)
            ->findAll();
    }

    public function countTodayBookings()
    {
        return $this->where('booking_date', date('Y-m-d'))->countAllResults();
    }

    public function getTodayBookings()
    {
        return $this->select('fieldbookings.*, lapangan.nama AS field_name')
            ->join('lapangan', 'lapangan.lapangan_id = fieldbookings.lapangan_id', 'left')
            ->where('fieldbookings.booking_date', date('Y-m-d'))
            ->where('lapangan.delete_sts', 0)
            ->findAll();
    }
}
