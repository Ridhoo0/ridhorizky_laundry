<?php
// memanggil library FPDF
require('../../assets/fpdf.php');
include_once '../../controllers/c_koneksi.php';

$data = new c_koneksi();
$conn = $data->koneksi();

// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

$pdf->SetFont('Times', 'B', 13);
$pdf->Cell(200, 10, 'DATA TRANSAKSI', 0, 0, 'C');

$pdf->Cell(10, 15, '', 0, 1);
$pdf->SetFont('Times', 'B', 9);
$pdf->Cell(10, 7, 'NO', 1, 0, 'C');
$pdf->Cell(30, 7, 'Kode Invoice', 1, 0, 'C');
$pdf->Cell(30, 7, 'Nama Pelanggan', 1, 0, 'C');
$pdf->Cell(25, 7, 'Tanggal Masuk', 1, 0, 'C');
$pdf->Cell(45, 7, 'Tanggal Pengambilan', 1, 0, 'C');
$pdf->Cell(15, 7, 'Status', 1, 0, 'C');
$pdf->Cell(25, 7, 'Bayar', 1, 0, 'C');


$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Times', '', 10);
$no = 1;
$data = mysqli_query($conn, "SELECT tb_transaksi.id, tb_transaksi.kode_invoice, tb_member.nama AS member_nama, tb_transaksi.tgl, tb_transaksi.batas_waktu, tb_transaksi.status, tb_transaksi.dibayar FROM tb_transaksi JOIN tb_member ON tb_transaksi.id_member = tb_member.id  JOIN tb_outlet ON tb_transaksi.id_outlet = tb_outlet.id JOIN tb_user ON tb_transaksi.id_user = tb_user.id JOIN tb_paket ON tb_transaksi.id_paket = tb_paket.id");
while ($d = mysqli_fetch_array($data)) {
    $pdf->Cell(10, 6, $no++, 1, 0, 'C');
    $pdf->Cell(30, 6, $d['kode_invoice'], 1, 0);
    $pdf->Cell(30, 6, $d['member_nama'], 1, 0, 'C');
    $pdf->Cell(25, 6, $d['tgl'], 1, 0, 'C');
    $pdf->Cell(45, 6, $d['batas_waktu'], 1, 0, 'C');
    $pdf->Cell(15, 6, $d['status'], 1, 0, 'C');
    $pdf->Cell(25, 6, $d['dibayar'], 1, 1, 'C');
}

$pdf->Output();