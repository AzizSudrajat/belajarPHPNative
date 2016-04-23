<?php
// format tgl indonesia
function tgl_indonesia($date){
  // array hari dan bulan
  $Hari = array("Minggu","Senin","Selasa","Rabu","Kaamis","Jum'at","Sabtu");
  $Bulan = array("January",
  "February","Maret",
  "April","Mei","Juni",
  "juli","Agustus",
  "September","Oktober",
  "November","Desember");

  // memisahkan format tanggal, bulan, hari, tahun dengan substring
  $tahun = substr($date, 0, 4);
  $bulan = substr($date, 5, 2);
  $tgl   = substr($date, 8, 2);
  $waktu = substr($date, 11, 5);
  $hari  = date("w", strtotime($date));

  $result = $Hari[$hari]." , ".$tgl." ".$Bulan[(int)$bulan-1]." ".$tahun." ".$waktu." WIB";
  return $result;
}

?>
