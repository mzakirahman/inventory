<?php


function get_role($role)
{
    if ($role == "1") {
        return "Admin";
    }
    if ($role == "2") {
        return "Karyawan";
    }
    if ($role == "3") {
        return "Supervisor";
    }
    if ($role == "4") {
        return "Manager";
    }
}

function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, '0', ',', '.');
    return $hasil_rupiah;
}

function create_guid()
{
    if (function_exists('com_create_guid') === true) {
        return trim(com_create_guid(), '{}');
    }
    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

function tgl_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

function encrypt_url($string)
{
    $output = false;
    $secret_key     = '1111111111111111';
    $secret_iv      = '2456378494765431';
    $encrypt_method = 'aes-256-cbc';

    // hash
    $key    = hash("sha256", $secret_key);

    // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
    $iv     = substr(hash("sha256", $secret_iv), 0, 16);

    //do the encryption given text/string/number
    $result = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($result);
    return $output;
}



function decrypt_url($string)
{

    $output = false;
    $secret_key     = '1111111111111111';
    $secret_iv      = '2456378494765431';
    $encrypt_method = 'aes-256-cbc';

    // hash
    $key    = hash("sha256", $secret_key);

    // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
    $iv = substr(hash("sha256", $secret_iv), 0, 16);

    //do the decryption given text/string/number

    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    return $output;
}

function getuniqueChar()
{
    $uniqueChar = array("x", "V", "a", "F", "t", "p", "7", "-", "d", "R");
    return $uniqueChar;
}
function encrypt_int($text)
{
    $text = $text * 227832;
    $rand = getuniqueChar();
    $out = "";
    $text .= ""; //$text.$dd[1];
    for ($i = 0; $i < strlen($text); $i++) {
        # code...
        $idx = $text[$i];
        $out .= $rand[$idx];
    }
    return $out;
}

function decrypt_int($text)
{
    $rand = getuniqueChar();
    $out = "";
    for ($i = 0; $i < strlen($text); $i++) {
        # code...
        $idx = $text[$i];
        $tmp = "-1";
        for ($j = 0; $j < count($rand); $j++) {
            # code...
            if ($idx == $rand[$j]) {
                $tmp = $j;
            }
        }
        $out .= $tmp;
        if ($tmp == "-1") {
            $out = "0";
            // JsAlertRedirect("", "Data tidak ditemukan");
            break;
        }
    }
    if ($out <> "0") {
        $end = strlen($out) - 2;
        $out = $out / 227832;
        $tmp1 = intval($out);
        if ($out <> $tmp1) {
            $out = 0;
        }
    }
    return $out;
}

function bulan_indo($angka)
{
    if ($angka == '1' or $angka == '01') {
        $bulan = "Januari";
    }
    if ($angka == '2' or $angka == '02') {
        $bulan = "Februari";
    }
    if ($angka == '3' or $angka == '03') {
        $bulan = "Maret";
    }
    if ($angka == '4' or $angka == '04') {
        $bulan = "April";
    }
    if ($angka == '5' or $angka == '05') {
        $bulan = "Mei";
    }
    if ($angka == '6' or $angka == '06') {
        $bulan = "Juni";
    }
    if ($angka == '7' or $angka == '07') {
        $bulan = "Juli";
    }
    if ($angka == '8' or $angka == '08') {
        $bulan = "Agustus";
    }
    if ($angka == '9' or $angka == '09') {
        $bulan = "September";
    }
    if ($angka == '10') {
        $bulan = "Oktober";
    }
    if ($angka == '11') {
        $bulan = "November";
    }
    if ($angka == '12') {
        $bulan = "Desember";
    }
    return $bulan;
}
