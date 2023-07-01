<?php


class Konversi
{

    //buat function konversi tanggal indo
    function hariIndo($x)
    {

        $month = '';
        $pisah = explode(',', $x);
        $hari = $pisah[0];

        $pisah2 = explode('-', $pisah[1]);
        $bulan = $pisah2[1];

        //konversi penamaan hari
        if ($hari == 'Monday') {
            $day = "Senin";
        } else if ($hari == 'Tuesday') {
            $day = "Selasa";
        } else if ($hari == 'Wednesday') {
            $day = "Rabu";
        } else if ($hari == 'Thursday') {
            $day = "Kamis";
        } else if ($hari == 'Friday') {
            $day = "Jumat";
        } else if ($hari == 'Saturday') {
            $day = "Sabtu";
        } else if ($hari == 'Sunday') {
            $day = "Minggu";
        }

        //konversi penamaan bulan
        if ($bulan == 'January') {
            $month = "Januari";
        } else if ($bulan == 'February') {
            $month = "Februari";
        } else if ($bulan == 'March') {
            $month = "Maret";
        } else if ($bulan == 'April') {
            $month = "April";
        } else if ($bulan == 'May') {
            $month = "Mei";
        } else if ($bulan == 'June') {
            $month = "Juni";
        } else if ($bulan == 'July') {
            $month = "Juli";
        } else if ($bulan == 'August') {
            $month = "Agustus";
        } else if ($bulan == 'September') {
            $month = "September";
        } else if ($bulan == 'October') {
            $month = "Oktober";
        } else if ($bulan == 'November') {
            $month = "November";
        } else if ($bulan == 'December') {
            $month = "Desember";
        }



        $waktuIndo = $day . "," . $pisah2[0] . "-" . $month . "-" . $pisah2[2];
        return $waktuIndo;
    }

    //buat function konversi tanggal indo
    function dateIndo($x)
    {

        $pisah = explode('-', $x);
        $tahun = $pisah[0];
        $bulan = $pisah[1];
        $tgl = $pisah[2];

        //buat penamaan bulan
        if ($pisah[1] == 1) {
            $bln = "Jan";
        } else if ($pisah[1] == 2) {
            $bln = "Feb";
        } else if ($pisah[1] == 3) {
            $bln = "Mar";
        } else if ($pisah[1] == 4) {
            $bln = "Apr";
        } else if ($pisah[1] == 5) {
            $bln = "May";
        } else if ($pisah[1] == 6) {
            $bln = "Jun";
        } else if ($pisah[1] == 7) {
            $bln = "Jul";
        } else if ($pisah[1] == 8) {
            $bln = "Aug";
        } else if ($pisah[1] == 9) {
            $bln = "Sep";
        } else if ($pisah[1] == 10) {
            $bln = "Oct";
        } else if ($pisah[1] == 11) {
            $bln = "Nov";
        } else if ($pisah[1] == 12) {
            $bln = "Dec";
        } else if ($pisah[1] == 00) {
            $bln = "00";
        }

        $tglIndo = $pisah[2] . "-" . $bln . "-" . $pisah[0];
        return $tglIndo;
    }

    function penyebut($nilai)
    {
        $nilai = abs($nilai);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " " . $huruf[$nilai];
        } else if ($nilai < 20) {
            $temp = $this->penyebut($nilai - 10) . " belas";
        } else if ($nilai < 100) {
            $temp = $this->penyebut($nilai / 10) . " puluh" . $this->penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . $this->penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = $this->penyebut($nilai / 100) . " ratus" . $this->penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . $this->penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = $this->penyebut($nilai / 1000) . " ribu" . $this->penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = $this->penyebut($nilai / 1000000) . " juta" . $this->penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = $this->penyebut($nilai / 1000000000) . " milyar" . $this->penyebut(fmod($nilai, 1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = $this->penyebut($nilai / 1000000000000) . " trilyun" . $this->penyebut(fmod($nilai, 1000000000000));
        }
        return $temp;
    }

    function terbilang($nilai)
    {
        if ($nilai < 0) {
            $hasil = "minus " . trim($this->penyebut($nilai));
        } else {
            $hasil = trim($this->penyebut($nilai));
        }
        return $hasil;
    }
}
