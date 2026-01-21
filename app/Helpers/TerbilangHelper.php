<?php

if (!function_exists('terbilang')) {
    function terbilang($angka)
    {
        $angka = (int)$angka;
        $huruf = [
            "",
            "satu",
            "dua",
            "tiga",
            "empat",
            "lima",
            "enam",
            "tujuh",
            "delapan",
            "sembilan"
        ];
        
        $belasan = [
            "sepuluh",
            "sebelas",
            "dua belas",
            "tiga belas",
            "empat belas",
            "lima belas",
            "enam belas",
            "tujuh belas",
            "delapan belas",
            "sembilan belas"
        ];

        $satuan = [
            "",
            "ribu",
            "juta",
            "miliar",
            "triliun"
        ];

        if ($angka == 0) {
            return "nol";
        }

        if ($angka < 0) {
            return "minus " . terbilang(-1 * $angka);
        }

        $angka_str = (string)$angka;
        $panjang = strlen($angka_str);
        $pemisah = 3 - ($panjang % 3);
        $angka_pisah = "";

        for ($i = 0; $i < $panjang; $i++) {
            if ($pemisah == 3) {
                $angka_pisah .= " ";
                $pemisah = 0;
            }
            $angka_pisah .= $angka_str[$i];
            $pemisah++;
        }

        $angka_pisah = trim($angka_pisah);
        $angka_array = explode(" ", $angka_pisah);
        $jumlah_satuan = count($angka_array);
        
        $hasil = "";

        for ($i = 0; $i < count($angka_array); $i++) {
            $angka_bagian = (int)$angka_array[$i];

            if ($angka_bagian == 0) {
                continue;
            } else if ($angka_bagian < 10) {
                $hasil .= $huruf[$angka_bagian];
            } else if ($angka_bagian < 20) {
                $hasil .= $belasan[$angka_bagian - 10];
            } else if ($angka_bagian < 100) {
                $hasil .= $huruf[floor($angka_bagian / 10)] . " puluh";
                if ($angka_bagian % 10 != 0) {
                    $hasil .= " " . $huruf[$angka_bagian % 10];
                }
            } else if ($angka_bagian < 1000) {
                $hasil .= $huruf[floor($angka_bagian / 100)] . " ratus";
                if ($angka_bagian % 100 != 0) {
                    if ($angka_bagian % 100 < 10) {
                        $hasil .= " " . $huruf[$angka_bagian % 100];
                    } else if ($angka_bagian % 100 < 20) {
                        $hasil .= " " . $belasan[$angka_bagian % 100 - 10];
                    } else {
                        $hasil .= " " . $huruf[floor(($angka_bagian % 100) / 10)] . " puluh";
                        if ($angka_bagian % 10 != 0) {
                            $hasil .= " " . $huruf[$angka_bagian % 10];
                        }
                    }
                }
            }

            if ($jumlah_satuan - $i - 1 > 0) {
                $hasil .= " " . $satuan[$jumlah_satuan - $i - 1] . " ";
            }
        }

        return trim($hasil);
    }
}
