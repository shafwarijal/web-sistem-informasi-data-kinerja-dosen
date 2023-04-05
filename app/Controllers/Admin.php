<?php

namespace App\Controllers;

use App\Models\Penelitian_model;
use App\Models\Pemakalah_model;
use App\Models\Dosen_model;
use App\Models\Anggota_model;
use App\Models\Buku_Ajar_model;
use App\Models\Hki_model;
use App\Models\Jurnal_model;

class Admin extends BaseController
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


    public function tahun()
    {
        $query = $this->db->query('SELECT * FROM (SELECT tahun_penelitian FROM penelitian UNION SELECT tahun_pemakalah FROM pemakalah UNION SELECT tahun_jurnal FROM jurnal UNION SELECT tahun_hki FROM hki UNION SELECT tahun_buku_ajar FROM buku_ajar ORDER BY tahun_penelitian DESC LIMIT 6) AS totaltahun ORDER BY tahun_penelitian ASC');

        return $query;
    }

    public function totalpenelitian()
    {
        $total = "";
        $builder = $this->db->table('penelitian');

        foreach ($this->tahun()->getResultArray() as $tahunpen) {

            $builder->where('tahun_penelitian', $tahunpen['tahun_penelitian']);
            $total .= $builder->countAllResults('FALSE') . ',';
        }

        return  $total;
    }


    public function totalpemakalah()
    {
        $total = "";
        $builder = $this->db->table('pemakalah');

        foreach ($this->tahun()->getResultArray() as $tahunpem) {

            $builder->where('tahun_pemakalah', $tahunpem['tahun_penelitian']);
            $total .= $builder->countAllResults('FALSE') . ',';
        }

        return  $total;
    }

    public function totaljurnal()
    {
        $total = "";
        $builder = $this->db->table('jurnal');

        foreach ($this->tahun()->getResultArray() as $tahunjur) {

            $builder->where('tahun_jurnal', $tahunjur['tahun_penelitian']);
            $total .= $builder->countAllResults('FALSE') . ',';
        }

        return  $total;
    }

    public function totalhki()
    {
        $total = "";
        $builder = $this->db->table('hki');

        foreach ($this->tahun()->getResultArray() as $tahunhki) {

            $builder->where('tahun_hki', $tahunhki['tahun_penelitian']);
            $total .= $builder->countAllResults('FALSE') . ',';
        }

        return  $total;
    }

    public function totalbukuajar()
    {
        $total = "";
        $builder = $this->db->table('buku_ajar');

        foreach ($this->tahun()->getResultArray() as $tahunbukuajar) {

            $builder->where('tahun_buku_ajar', $tahunbukuajar['tahun_penelitian']);
            $total .= $builder->countAllResults('FALSE') . ',';
        }

        return  $total;
    }


    public function index()
    {
        if (session()->get('role') == "2") {
            return redirect()->to(base_url('user'));
        } elseif (session()->get('role') == "1") {
            $jumlahdosen = $this->dosen->countAllResults();
            $jumlahpenelitian = $this->penelitian->countAllResults();
            $jumlahpemakalah = $this->makalah->countAllResults();
            $jumlahjurnal = $this->jurnal->countAllResults();
            $jumlahhki = $this->hki->countAllResults();
            $jumlahbukuajar = $this->bukuajar->countAllResults();

            $grafik_tahun_penelitian = $this->penelitian->select('YEAR(tahun_penelitian) AS tahun, COUNT(id_penelitian) AS jumlah')
                ->groupBy('YEAR(tahun_penelitian)')
                ->get();

            $tahun  = $this->tahun();
            $total = $this->totalpenelitian();
            $totalpemakalah = $this->totalpemakalah();
            $totaljurnal = $this->totaljurnal();
            $totalhki = $this->totalhki();
            $totalbukuajar = $this->totalbukuajar();

            $data = [

                'tahun' => $tahun,
                'total' => $total,
                'totalpemakalah' => $totalpemakalah,
                'totaljurnal' => $totaljurnal,
                'totalhki' => $totalhki,
                'totalbukuajar' => $totalbukuajar,
                'jumlah_dosen' => $jumlahdosen,
                'jumlah_penelitian' => $jumlahpenelitian,
                'jumlah_pemakalah' => $jumlahpemakalah,
                'jumlah_jurnal' => $jumlahjurnal,
                'jumlah_hki' => $jumlahhki,
                'jumlah_buku_ajar' => $jumlahbukuajar,
                'grafik_tahun_penelitian' => $grafik_tahun_penelitian


            ];


            return view('pages/admin/a_dashboard/index_admin', $data);
        } else {
            exit('404 Not Found');
        }
    }

    function tampilgrafiktingkat()
    {
        $jenis = $this->request->getPost('jenis');

        $query = $this->db->query("SELECT COUNT(*) as jumlahjenis, tingkat FROM $jenis GROUP BY CASE WHEN tingkat = 'Regional' THEN 1 WHEN tingkat = 'Nasional' THEN 2 WHEN tingkat = 'Internasional' THEN 3 END ASC")->getResult();

        $data = [
            'grafik' => $query
        ];

        $json = [
            'output' => view('pages/admin/a_dashboard/index', $data)
        ];

        echo json_encode($json);
    }
}
