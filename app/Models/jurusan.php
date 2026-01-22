<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusan'; // <-- SESUAIKAN
    protected $fillable = ['nama_jurusan', 'kuota'];

    /**
     * Get the count of accepted students in this major
     */
    public function getAcceptedCount()
    {
        return FormulirPendaftaran::where('jurusan_id', $this->id)
            ->where('status_pendaftaran', 'diterima')
            ->count();
    }

    /**
     * Check if quota is still available
     */
    public function isQuotaAvailable()
    {
        if ($this->kuota <= 0) {
            return true; // No limit set
        }
        return $this->getAcceptedCount() < $this->kuota;
    }

    /**
     * Get available quota
     */
    public function getAvailableQuota()
    {
        if ($this->kuota <= 0) {
            return null; // No limit
        }
        return max(0, $this->kuota - $this->getAcceptedCount());
    }
}
