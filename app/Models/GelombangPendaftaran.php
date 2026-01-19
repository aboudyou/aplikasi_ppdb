<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GelombangPendaftaran extends Model
{
    use HasFactory;

    protected $table = 'gelombang_pendaftaran';
    protected $fillable = ['nama_gelombang', 'tanggal_mulai', 'tanggal_selesai', 'nilai', 'kuota_maksimal', 'jenis_promo', 'nilai_promo', 'tipe_nilai_promo', 'catatan', 'keterangan'];

    /**
     * Hitung biaya akhir setelah promo
     */
    public function getBiayaAkhir()
    {
        $biaya = $this->nilai ?? 0;

        if (!$this->jenis_promo || $this->nilai_promo == 0) {
            return $biaya;
        }

        if ($this->jenis_promo === 'diskon') {
            if ($this->tipe_nilai_promo === 'persen') {
                // Diskon persentase
                $diskon = ($biaya * $this->nilai_promo) / 100;
                return $biaya - $diskon;
            } else {
                // Diskon nominal
                return $biaya - $this->nilai_promo;
            }
        } elseif ($this->jenis_promo === 'potongan') {
            if ($this->tipe_nilai_promo === 'persen') {
                // Potongan persentase (sama seperti diskon)
                $potongan = ($biaya * $this->nilai_promo) / 100;
                return $biaya - $potongan;
            } else {
                // Potongan nominal
                return $biaya - $this->nilai_promo;
            }
        }

        return $biaya;
    }

    /**
     * Hitung nilai promo
     */
    public function getNilaiPromo()
    {
        $biaya = $this->nilai ?? 0;

        if (!$this->jenis_promo || $this->nilai_promo == 0) {
            return 0;
        }

        if ($this->tipe_nilai_promo === 'persen') {
            return ($biaya * $this->nilai_promo) / 100;
        }

        return $this->nilai_promo;
    }

    /**
     * Hitung jumlah peserta yang sudah terdaftar di gelombang ini
     */
    public function getJumlahPeserta()
    {
        return FormulirPendaftaran::where('gelombang_id', $this->id)
            ->whereNotIn('status_pendaftaran', ['batal'])
            ->count();
    }

    /**
     * Hitung sisa kuota
     */
    public function getSisaKuota()
    {
        if ($this->kuota_maksimal == 0) {
            return -1; // Tidak ada batasan kuota
        }

        return $this->kuota_maksimal - $this->getJumlahPeserta();
    }

    /**
     * Cek apakah kuota masih tersedia
     */
    public function isKuotaTersedia()
    {
        if ($this->kuota_maksimal == 0) {
            return true; // Tidak ada batasan
        }

        return $this->getJumlahPeserta() < $this->kuota_maksimal;
    }
}
