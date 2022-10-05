<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location:../../../auth/login");
  exit;
}

require('../../../funct/functions.php');

// SESSION USER LOGIN
if (isset($_SESSION["login"])) {

  $userSession = $_SESSION["username"];
  $resultSession = $conn->query("SELECT * FROM tb_users WHERE username = '$userSession' ");
  $rowSession = mysqli_fetch_assoc($resultSession);
  $idSession = $rowSession["id"];
}
// CEK LEVEL
include("../../../include/check-level.php");
if (($rowSession["level"] === $levelPPK)) {
  header("Location:../../");
  exit;
}
// membaca data dari form
$noBlnAngka = $_POST["no_bln_angka"];
$noTgl = $_POST["no_tgl"];
$noKegiatan = $_POST["no_kegiatan"];
$noBlnRomawi = $_POST["no_bln_romawi"];
$noTahun = $_POST["no_tahun"];
$hariTerbilang = $_POST["hari_terbilang"];
$tglTerbilang = $_POST["tgl_terbilang"];
$blnTerbilang = $_POST["bln_terbilang"];
$thnTerbilang = $_POST["thn_terbilang"];
$namaSatker = $_POST["nama_satker"];
$namaPerusahaan = $_POST["nama_perusahaan"];
$alamatPerusahaan = $_POST["alamat_perusahaan"];
$namaPekerjaan = $_POST["nama_pekerjaan"];
$tahunAnggaran = $_POST["tahun_anggaran"];
$jmlhPenawaran = $_POST["jmlh_penawaran"];
$jmlhPenawaranTerbilang = $_POST["jmlh_penawaran_terbilang"];
$jmlhNegosiasi = $_POST["jmlh_negosiasi"];
$jmlhNegosiasiTerbilang = $_POST["jmlh_negosiasi_terbilang"];
$selisih = $_POST["selisih"];
$selisihTerbilang = $_POST["selisih_terbilang"];
$namaPp = $_POST["nama_pp"];
$namaWakilPenyedia = $_POST["nama_wakil_penyedia"];
// memanggil dan membaca template dokumen yang telah kita buat
$document = file_get_contents("bahkn.rtf");

// isi dokumen dinyatakan dalam bentuk string
$document = str_replace("%%no_bln_angka%%", $noBlnAngka, $document);
$document = str_replace("%%no_tgl%%", $noTgl, $document);
$document = str_replace("%%no_kegiatan%%", $noKegiatan, $document);
$document = str_replace("%%no_bln_romawi%%", $noBlnRomawi, $document);
$document = str_replace("%%no_tahun%%", $noTahun, $document);
$document = str_replace("%%hari_terbilang%%", $hariTerbilang, $document);
$document = str_replace("%%tgl_terbilang%%", $tglTerbilang, $document);
$document = str_replace("%%bln_terbilang%%", $blnTerbilang, $document);
$document = str_replace("%%thn_terbilang%%", $thnTerbilang, $document);
$document = str_replace("%%nama_satker%%", $namaSatker, $document);
$document = str_replace("%%nama_perusahaan%%", $namaPerusahaan, $document);
$document = str_replace("%%alamat_perusahaan%%", $alamatPerusahaan, $document);
$document = str_replace("%%nama_pekerjaan%%", $namaPekerjaan, $document);
$document = str_replace("%%tahun_anggaran%%", $tahunAnggaran, $document);
$document = str_replace("%%jmlh_penawaran%%", $jmlhPenawaran, $document);
$document = str_replace("%%jmlh_penawaran_terbilang%%", $jmlhPenawaranTerbilang, $document);
$document = str_replace("%%jmlh_negosiasi%%", $jmlhNegosiasi, $document);
$document = str_replace("%%jmlh_negosiasi_terbilang%%", $jmlhNegosiasiTerbilang, $document);
$document = str_replace("%%selisih%%", $selisih, $document);
$document = str_replace("%%selisih_terbilang%%", $selisihTerbilang, $document);
$document = str_replace("%%nama_pp%%", $namaPp, $document);
$document = str_replace("%%nama_wakil_penyedia%%", $namaWakilPenyedia, $document);
// header untuk membuka file output RTF dengan MS. Word
header("Content-type: application/msword");
header("Content-disposition: inline; filename=4b_PP_BA Hasil Klarifikasi dan Negosiasi.doc");
header("Content-length: " . strlen($document));
echo $document;
