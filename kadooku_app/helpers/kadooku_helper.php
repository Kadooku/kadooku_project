<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Fungsi untuk menghasilkan hash password
 * @param   [string]    $pass
 * @param   [int]       jumlah panjang hashing
 * @return  [string]    teks enkripsi
 * @author Rangga Djatikusuma Lukman
 */
function bCrypt($pass,$cost){
        $chars='./ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $salt=sprintf('$2a$%02d$',$cost);
        mt_srand();
        for($i=0;$i<22;$i++) $salt.=$chars[mt_rand(0,63)];

        return crypt($pass,$salt);
}

function rupiah($number = 0)
{
        $hasil_rupiah = "Rp " . number_format($number,0,',','.');
	return $hasil_rupiah;
}
?>