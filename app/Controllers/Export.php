<?php



namespace App\Controllers;


use App\Models\Penelitian_model;
use App\Models\Pemakalah_model;
use App\Models\Dosen_model;
use App\Models\Anggota_model;
use App\Models\Buku_Ajar_model;
use App\Models\Hki_model;
use App\Models\Jurnal_model;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Export extends BaseController
{
    public function __construct()
    {

        $this->db = db_connect();
        $this->penelitian = new Penelitian_model();
        $this->dosen = new Dosen_model();
        $this->anggotapenelitian = new Anggota_model();
        $this->makalah = new Pemakalah_model();
        $this->bukuajar = new Buku_Ajar_model();
        $this->hki = new Hki_model();
        $this->jurnal = new Jurnal_model();
        helper('form');
    }

    public function index()
    {

        if (session()->get('role') == "1") {
            return view('pages/admin/a_export/index');
        } else {
            exit('404 Not Found');
        }
    }

    public function laporan()
    {
        $jenislaporan = $this->request->getPost('jenis_data');
        $tahunlaporan = $this->request->getPost('tahun_data');
        $tombol = $this->request->getPost('btnexport');



        if ($jenislaporan == 'penelitian') {
            $penelitian = $this->db->query("SELECT penelitian.*, dosen.*, agt.*
                FROM penelitian 
                JOIN dosen ON penelitian.nidn_ketua = dosen.nidn
                LEFT JOIN (SELECT anggota_penelitian.id_pen, GROUP_CONCAT(dosen.nama_dosen SEPARATOR ', ') as nama_agt 
                FROM anggota_penelitian
                JOIN dosen ON anggota_penelitian.nidn = dosen.nidn
                GROUP BY anggota_penelitian.id_pen) agt ON penelitian.id_penelitian = agt.id_pen 
                WHERE 
                tahun_penelitian LIKE '$tahunlaporan'
                ORDER BY nama_skema ASC");
        } elseif ($jenislaporan == 'pemakalah') {
            $pemakalah = $this->db->query("SELECT pemakalah.*, dosen.*
                FROM pemakalah
                JOIN dosen ON pemakalah.nidn_pem = dosen.nidn
                WHERE 
                tahun_pemakalah LIKE '$tahunlaporan'
                ORDER BY tingkat ASC");
        } elseif ($jenislaporan == 'jurnal') {
            $jurnal = $this->db->query("SELECT *
                FROM jurnal
                WHERE 
                tahun_jurnal LIKE '$tahunlaporan'
                ORDER BY tingkat ASC");
        } elseif ($jenislaporan == 'hki') {
            $hki = $this->db->query("SELECT hki.*, dosen.*
                FROM hki
                JOIN dosen ON hki.nidn_hki = dosen.nidn
                WHERE 
                tahun_hki LIKE '$tahunlaporan'
                ORDER BY nama_dosen ASC");
        } elseif ($jenislaporan == 'buku_ajar') {
            $bukuajar = $this->db->query("SELECT buku_ajar.*, dosen.*
                FROM buku_ajar
                JOIN dosen ON buku_ajar.nidn_buku_ajar = dosen.nidn
                WHERE 
                tahun_buku_ajar LIKE '$tahunlaporan'
                ORDER BY nama_dosen ASC");
        }


        if (isset($tombol)) {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $column = 2;
            if ($jenislaporan == 'penelitian') {
                $sheet->setCellValue('A1', 'No');
                $sheet->setCellValue('B1', 'Nidn Ketua');
                $sheet->setCellValue('C1', 'Nama Ketua');
                $sheet->setCellValue('D1', 'Nama Anggota');
                $sheet->setCellValue('E1', 'Judul Penelitian');
                $sheet->setCellValue('F1', 'Nama Skema');
                $sheet->setCellValue('G1', 'Jumlah Dana');
                $sheet->setCellValue('H1', 'Tahun Penelitian');
                $sheet->setCellValue('I1', 'Bidang Penelitian');
                $sheet->setCellValue('J1', 'Bidang Penelitian Lain');
                $sheet->setCellValue('K1', 'Tujuan Sosial Ekonomi');
                $sheet->setCellValue('L1', 'Tujuan Sosial Ekonomi Lain');

                foreach ($penelitian->getResultArray() as $row) {
                    $sheet->setCellValue('A' . $column, ($column - 1));
                    $sheet->setCellValue('B' . $column, $row['nidn_ketua']);
                    $sheet->setCellValue('C' . $column, $row['nama_dosen']);
                    $sheet->setCellValue('D' . $column, $row['nama_agt']);
                    $sheet->setCellValue('E' . $column, $row['judul_penelitian']);
                    $sheet->setCellValue('F' . $column, $row['nama_skema']);
                    $sheet->setCellValue('G' . $column, $row['jumlah_dana']);
                    $sheet->setCellValue('H' . $column, $row['tahun_penelitian']);
                    $sheet->setCellValue('I' . $column, $row['bidang_penelitian']);
                    $sheet->setCellValue('J' . $column, $row['bidang_penelitian_lain']);
                    $sheet->setCellValue('K' . $column, $row['tujuan_sosial_ekonomi']);
                    $sheet->setCellValue('L' . $column, $row['tujuan_sosial_ekonomi_lain']);
                    $column++;
                }

                $sheet->getColumnDimension('A')->setAutoSize(true);
                $sheet->getColumnDimension('B')->setAutoSize(true);
                $sheet->getColumnDimension('C')->setAutoSize(true);
                $sheet->getColumnDimension('D')->setAutoSize(true);
                $sheet->getColumnDimension('E')->setAutoSize(true);
                $sheet->getColumnDimension('F')->setAutoSize(true);
                $sheet->getColumnDimension('G')->setAutoSize(true);
                $sheet->getColumnDimension('H')->setAutoSize(true);
                $sheet->getColumnDimension('I')->setAutoSize(true);
                $sheet->getColumnDimension('J')->setAutoSize(true);
                $sheet->getColumnDimension('K')->setAutoSize(true);
                $sheet->getColumnDimension('L')->setAutoSize(true);

                $writer = new Xlsx($spreadsheet);
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment; filename= Data Penelitian Hibah Ditlitabmas Universitas Gunadarma ' . $tahunlaporan . '.xlsx');
                header('Cache-Control: max-age=0');

                $writer->save('php://output');
            } elseif ($jenislaporan == 'pemakalah') {
                $sheet->setCellValue('A1', 'No');
                $sheet->setCellValue('B1', 'Nidn');
                $sheet->setCellValue('C1', 'Nama Lengkap');
                $sheet->setCellValue('D1', 'Status Pemakalah');
                $sheet->setCellValue('E1', 'Judul Pemakalah');
                $sheet->setCellValue('F1', 'Tingkat');
                $sheet->setCellValue('G1', 'Nama Forum');
                $sheet->setCellValue('H1', 'Intitusi Penyelenggara');
                $sheet->setCellValue('I1', 'Tanggal Mulai Pelaksanaan');
                $sheet->setCellValue('J1', 'Tanggal Akhir Pelaksanaan');
                $sheet->setCellValue('K1', 'Tahun Pemakalah');
                $sheet->setCellValue('L1', 'Tempat Pelaksanaan');
                $sheet->setCellValue('M1', 'Kd Sts Berkas Makalah');
                $sheet->setCellValue('N1', 'Keterangan Invalid');

                foreach ($pemakalah->getResultArray() as $row) {
                    $sheet->setCellValue('A' . $column, ($column - 1));
                    $sheet->setCellValue('B' . $column, $row['nidn_pem']);
                    $sheet->setCellValue('C' . $column, $row['nama_dosen']);
                    $sheet->setCellValue('D' . $column, $row['status_pemakalah']);
                    $sheet->setCellValue('E' . $column, $row['judul_makalah']);
                    $sheet->setCellValue('F' . $column, $row['tingkat']);
                    $sheet->setCellValue('G' . $column, $row['nama_forum']);
                    $sheet->setCellValue('H' . $column, $row['institusi_penyelenggara']);
                    $sheet->setCellValue('I' . $column, $row['tgl_mulai_pelaksanaan']);
                    $sheet->setCellValue('J' . $column, $row['tgl_akhir_pelaksanaan']);
                    $sheet->setCellValue('K' . $column, $row['tahun_pemakalah']);
                    $sheet->setCellValue('L' . $column, $row['tempat_pelaksanaan']);
                    $sheet->setCellValue('M' . $column, $row['kd_sts_berkas_makalah']);
                    $sheet->setCellValue('N' . $column, $row['keterangan_invalid']);

                    $column++;
                }

                $sheet->getColumnDimension('A')->setAutoSize(true);
                $sheet->getColumnDimension('B')->setAutoSize(true);
                $sheet->getColumnDimension('C')->setAutoSize(true);
                $sheet->getColumnDimension('D')->setAutoSize(true);
                $sheet->getColumnDimension('E')->setAutoSize(true);
                $sheet->getColumnDimension('F')->setAutoSize(true);
                $sheet->getColumnDimension('G')->setAutoSize(true);
                $sheet->getColumnDimension('H')->setAutoSize(true);
                $sheet->getColumnDimension('I')->setAutoSize(true);
                $sheet->getColumnDimension('J')->setAutoSize(true);
                $sheet->getColumnDimension('K')->setAutoSize(true);
                $sheet->getColumnDimension('L')->setAutoSize(true);
                $sheet->getColumnDimension('M')->setAutoSize(true);
                $sheet->getColumnDimension('N')->setAutoSize(true);

                $writer = new Xlsx($spreadsheet);
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment; filename= Data Pemakalah Forum Ilmiah Universitas Gunadarma ' . $tahunlaporan . '.xlsx');
                header('Cache-Control: max-age=0');

                $writer->save('php://output');
            } elseif ($jenislaporan == 'jurnal') {
                $sheet->setCellValue('A1', 'No');
                $sheet->setCellValue('B1', 'Judul Jurnal');
                $sheet->setCellValue('C1', 'Nama Jurnal');
                $sheet->setCellValue('D1', 'Nama Personil');
                $sheet->setCellValue('E1', 'ISSN');
                $sheet->setCellValue('F1', 'Volume');
                $sheet->setCellValue('G1', 'Nomor');
                $sheet->setCellValue('H1', 'Halaman Awal');
                $sheet->setCellValue('I1', 'Halaman Akhir');
                $sheet->setCellValue('J1', 'Tahun Jurnal');
                $sheet->setCellValue('K1', 'Tingkat');
                $sheet->setCellValue('L1', 'Status Akreditasi');
                $sheet->setCellValue('M1', 'URL');

                foreach ($jurnal->getResultArray() as $row) {
                    $sheet->setCellValue('A' . $column, ($column - 1));
                    $sheet->setCellValue('B' . $column, $row['judul_jurnal']);
                    $sheet->setCellValue('C' . $column, $row['nama_jurnal']);
                    $sheet->setCellValue('D' . $column, $row['nama_personil']);
                    $sheet->setCellValue('E' . $column, $row['issn']);
                    $sheet->setCellValue('F' . $column, $row['volume']);
                    $sheet->setCellValue('G' . $column, $row['nomor1']);
                    $sheet->setCellValue('H' . $column, $row['halaman_awal']);
                    $sheet->setCellValue('I' . $column, $row['halaman_akhir']);
                    $sheet->setCellValue('J' . $column, $row['tahun_jurnal']);
                    $sheet->setCellValue('K' . $column, $row['tingkat']);
                    $sheet->setCellValue('L' . $column, $row['status_akreditasi']);
                    $sheet->setCellValue('M' . $column, $row['url']);

                    $column++;
                }

                $sheet->getColumnDimension('A')->setAutoSize(true);
                $sheet->getColumnDimension('B')->setAutoSize(true);
                $sheet->getColumnDimension('C')->setAutoSize(true);
                $sheet->getColumnDimension('D')->setAutoSize(true);
                $sheet->getColumnDimension('E')->setAutoSize(true);
                $sheet->getColumnDimension('F')->setAutoSize(true);
                $sheet->getColumnDimension('G')->setAutoSize(true);
                $sheet->getColumnDimension('H')->setAutoSize(true);
                $sheet->getColumnDimension('I')->setAutoSize(true);
                $sheet->getColumnDimension('J')->setAutoSize(true);
                $sheet->getColumnDimension('K')->setAutoSize(true);
                $sheet->getColumnDimension('L')->setAutoSize(true);
                $sheet->getColumnDimension('M')->setAutoSize(true);


                $writer = new Xlsx($spreadsheet);
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment; filename= Data Jurnal Universitas Gunadarma ' . $tahunlaporan . '.xlsx');
                header('Cache-Control: max-age=0');

                $writer->save('php://output');
            } elseif ($jenislaporan == 'hki') {
                $sheet->setCellValue('A1', 'No');
                $sheet->setCellValue('B1', 'Nidn');
                $sheet->setCellValue('C1', 'Nama Lengkap');
                $sheet->setCellValue('D1', 'Judul HKI');
                $sheet->setCellValue('E1', 'Jenis HKI');
                $sheet->setCellValue('F1', 'No Pendaftaran');
                $sheet->setCellValue('G1', 'Status HKI');
                $sheet->setCellValue('H1', 'No HKI');
                $sheet->setCellValue('I1', 'Kd Sts Berkas HKI');
                $sheet->setCellValue('J1', 'Tahun HKI');
                $sheet->setCellValue('K1', 'Keterangan Invalid');


                foreach ($hki->getResultArray() as $row) {
                    $sheet->setCellValue('A' . $column, ($column - 1));
                    $sheet->setCellValue('B' . $column, $row['nidn_hki']);
                    $sheet->setCellValue('C' . $column, $row['nama_dosen']);
                    $sheet->setCellValue('D' . $column, $row['judul_hki']);
                    $sheet->setCellValue('E' . $column, $row['jenis_hki']);
                    $sheet->setCellValue('F' . $column, $row['no_pendaftaran']);
                    $sheet->setCellValue('G' . $column, $row['status_hki']);
                    $sheet->setCellValue('H' . $column, $row['no_hki']);
                    $sheet->setCellValue('I' . $column, $row['kd_sts_berkas_hki']);
                    $sheet->setCellValue('J' . $column, $row['tahun_hki']);
                    $sheet->setCellValue('K' . $column, $row['keterangan_invalid']);
                    $column++;
                }

                $sheet->getColumnDimension('A')->setAutoSize(true);
                $sheet->getColumnDimension('B')->setAutoSize(true);
                $sheet->getColumnDimension('C')->setAutoSize(true);
                $sheet->getColumnDimension('D')->setAutoSize(true);
                $sheet->getColumnDimension('E')->setAutoSize(true);
                $sheet->getColumnDimension('F')->setAutoSize(true);
                $sheet->getColumnDimension('G')->setAutoSize(true);
                $sheet->getColumnDimension('H')->setAutoSize(true);
                $sheet->getColumnDimension('I')->setAutoSize(true);
                $sheet->getColumnDimension('J')->setAutoSize(true);
                $sheet->getColumnDimension('K')->setAutoSize(true);

                $writer = new Xlsx($spreadsheet);
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment; filename= Data HKI Universitas Gunadarma ' . $tahunlaporan . '.xlsx');
                header('Cache-Control: max-age=0');

                $writer->save('php://output');
            } elseif ($jenislaporan == 'buku_ajar') {
                $sheet->setCellValue('A1', 'No');
                $sheet->setCellValue('B1', 'Nidn');
                $sheet->setCellValue('C1', 'Nama Lengkap');
                $sheet->setCellValue('D1', 'Judul');
                $sheet->setCellValue('E1', 'ISBN');
                $sheet->setCellValue('F1', 'Jumlah Halaman');
                $sheet->setCellValue('G1', 'Penerbit');
                $sheet->setCellValue('H1', 'Tahun Buku Ajar');
                $sheet->setCellValue('I1', 'Keterangan Invalid');


                foreach ($bukuajar->getResultArray() as $row) {
                    $sheet->setCellValue('A' . $column, ($column - 1));
                    $sheet->setCellValue('B' . $column, $row['nidn_buku_ajar']);
                    $sheet->setCellValue('C' . $column, $row['nama_dosen']);
                    $sheet->setCellValue('D' . $column, $row['judul_buku_ajar']);
                    $sheet->setCellValue('E' . $column, $row['isbn']);
                    $sheet->setCellValue('F' . $column, $row['jumlah_halaman']);
                    $sheet->setCellValue('G' . $column, $row['penerbit']);
                    $sheet->setCellValue('H' . $column, $row['tahun_buku_ajar']);
                    $sheet->setCellValue('I' . $column, $row['keterangan_invalid']);

                    $column++;
                }

                $sheet->getColumnDimension('A')->setAutoSize(true);
                $sheet->getColumnDimension('B')->setAutoSize(true);
                $sheet->getColumnDimension('C')->setAutoSize(true);
                $sheet->getColumnDimension('D')->setAutoSize(true);
                $sheet->getColumnDimension('E')->setAutoSize(true);
                $sheet->getColumnDimension('F')->setAutoSize(true);
                $sheet->getColumnDimension('G')->setAutoSize(true);
                $sheet->getColumnDimension('H')->setAutoSize(true);
                $sheet->getColumnDimension('I')->setAutoSize(true);

                $writer = new Xlsx($spreadsheet);
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment; filename= Data Buku Ajar Universitas Gunadarma ' . $tahunlaporan . '.xlsx');
                header('Cache-Control: max-age=0');

                $writer->save('php://output');
            }
        }
    }
}
