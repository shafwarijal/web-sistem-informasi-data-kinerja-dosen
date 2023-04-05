<?php

namespace App\Controllers;

use App\Models\Penelitian_model;
use App\Models\Dosen_model;
use App\Models\Anggota_model;
use App\Models\Pemakalah_model;
use App\Models\Jurnal_model;
use App\Models\Hki_model;

class Dashboard extends BaseController
{

    public function __construct()
    {
        require_once APPPATH . 'ThirdParty/ssp.class.php';
        $this->db = db_connect();
        $this->penelitian = new Penelitian_model();
        $this->dosen = new Dosen_model();
        $this->anggotapenelitian = new Anggota_model();
        $this->makalah = new Pemakalah_model();
        $this->jurnal = new Jurnal_model();
        $this->hki = new Hki_model();

        helper('form');
    }

    public function index()
    {
        if (session()->get('role') == "1") {
            return view('pages/admin/a_dashboard/index');
        } elseif (session()->get('role') == "2") {
            return view('pages/user/u_dashboard/index');
        } else {
            exit('404 Not Found');
        }
    }

    public function get_dashboard()
    {
        if ($this->request->isAJAX()) {
            if (session()->get('role') == "1") {
                $result = [
                    'output' => view('pages/admin/a_hki/list_hki')
                ];

                echo json_encode($result);
            } elseif (session()->get('role') == "2") {


                $page = (isset($_POST['page'])) ? $_POST['page'] : 1;

                $limit = 5;
                $limit_start = ($page - 1) * $limit;
                $no = $limit_start + 1;

                $s_jenis = "";
                $s_search = "";



                if (isset($_POST['jenis'])) {
                    $s_jenis = $_POST['jenis'];
                    $s_search = $_POST['search'];
                }


                $query = $this->db->query("SELECT hki.*, dosen.*
                FROM hki
                JOIN dosen ON hki.nidn_hki = dosen.nidn
                WHERE 
                jenis_hki LIKE '%$s_jenis%' AND
                (nama_dosen LIKE '%$s_search%' OR
                judul_hki LIKE '%$s_search%' OR
                no_pendaftaran LIKE '%$s_search%' OR
                status_hki LIKE '%$s_search%' OR
                no_hki LIKE '%$s_search%')
                ORDER BY nama_dosen ASC LIMIT $limit_start, $limit");



                $jmlData =  $this->db->query("SELECT count(*) as jumlah
                FROM hki
                JOIN dosen ON hki.nidn_hki = dosen.nidn
                WHERE 
                jenis_hki LIKE '%$s_jenis%' AND
                (nama_dosen LIKE '%$s_search%' OR
                judul_hki LIKE '%$s_search%' OR
                no_pendaftaran LIKE '%$s_search%' OR
                status_hki LIKE '%$s_search%' OR
                no_hki LIKE '%$s_search%')");


                $data = [
                    'data_hki' => $query,
                    'total' => $jmlData,


                ];
                return view('pages/user/u_hki/list_hki', $data);
            }
        } else {
            exit('404 Not Found');
        }
    }

    public function tahunpenelitian()
    {
        $query = $this->db->query('SELECT * FROM (SELECT DISTINCT tahun_penelitian FROM penelitian ORDER BY tahun_penelitian DESC LIMIT 6) as tahunpen ORDER BY tahun_penelitian ASC');

        return $query->getResultArray();
    }



    public function getAllhki()
    {


        $table = <<<EOT
            (
                SELECT hki.*, dosen.*
                FROM hki
                JOIN dosen ON hki.nidn_hki = dosen.nidn
            ) temp
    EOT;

        // Table's primary key
        $primaryKey = 'id_hki';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array('db' => 'nidn_hki', 'dt' => 1),
            array('db' => 'nama_dosen',  'dt' => 2),
            array('db' => 'judul_hki',     'dt' => 3),
            array('db' => 'jenis_hki',     'dt' => 4),
            array('db' => 'no_pendaftaran',     'dt' => 5),
            array('db' => 'status_hki',     'dt' => 6),
            array('db' => 'no_hki',     'dt' => 7),
            array('db' => 'kd_sts_berkas_hki',     'dt' => 8),
            array('db' => 'keterangan_invalid',     'dt' => 9),
            array('db' => 'id_hki',     'dt' => 10),
        );

        // SQL server connection information
        $sql_details = array(
            'user' => 'root',
            'pass' => '',
            'db'   => 'ekinerjadosen',
            'host' => 'localhost'
        );


        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
                * If you just want to use the basic configuration for DataTables with PHP
                * server-side, there is no need to edit below this line.
                */

        // require('ssp.class.php');

        echo json_encode(
            \SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
        );
    }

    public function get_add_hki()
    {
        if ($this->request->isAJAX()) {
            $result = [
                'output' => view('pages/modals/hki/add_hki')
            ];

            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }

    public function get_Dosen()
    {


        $dosen = new Dosen_model();
        $request = \Config\Services::request();
        $search = $request->getPostGet('term');
        $dosenlist = $dosen->select('nidn,nama_dosen')->like('nama_dosen', $search)->findAll(10);
        $data = array();
        foreach ($dosenlist as $dos) {
            $data[] = array(
                "value" => $dos['nidn'],
                "label" => $dos['nama_dosen'],
            );
        }
        echo json_encode($data);
    }

    public function getDosenAgt()
    {
        $request = \Config\Services::request();
        $postData = $request->getPost();

        $response = array();

        $data = array();

        $builder = $this->db->table("dosen");

        $dosen = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            // Fetch record
            $builder->select('nidn,nama_dosen');
            $builder->like('nama_dosen', $query, 'both');
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('nidn,nama_dosen');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $dos) {
            $dosen[] = array(
                'id' => $dos->nidn,
                'text' => $dos->nama_dosen,
            );
        }


        $response['data'] = $dosen;

        return $this->response->setJSON($response);
    }



    public function save_data()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();


            //niprule_is_unique

            $rules = $this->validate([
                'nidn_hki' => [
                    'label' => 'nidn_hki',
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided',
                        'min_length' => 'Minimal 3 huruf',
                    ],
                ],

                'judul_hki' => [
                    'label' => 'judul_hki',
                    'rules' => 'required|min_length[3]',
                ],

            ]);

            if (!$rules) {
                $result = [
                    'error' => [
                        'nidn_hki' => $validation->getError('nidn_hki'),
                        'judul_hki' => $validation->getError('judul_hki'),

                    ]
                ];
            } else {
                // if ($this->request->getPost('nidn') == null) {
                //     return view('pages/admin/u_dosen/index');
                // }

                $this->hki->insert([
                    'nidn_hki' => strip_tags($this->request->getPost('nidn_hki')),
                    // 'nama_dosen' => strip_tags($this->request->getPost('nama_dosen')),
                    'judul_hki' => strip_tags($this->request->getPost('judul_hki')),
                    'jenis_hki' => strip_tags($this->request->getPost('jenis_hki')),
                    'no_pendaftaran' => strip_tags($this->request->getPost('no_pendaftaran')),
                    'status_hki' => strip_tags($this->request->getPost('status_hki')),
                    'no_hki' => strip_tags($this->request->getPost('no_hki')),
                    'kd_sts_berkas_hki' => strip_tags($this->request->getPost('kd_sts_berkas_hki')),
                    'keterangan_invalid' => strip_tags($this->request->getPost('keterangan_invalid'))


                ]);

                // $idpenelitian = $data_penelitian->insertID();


                // $this->db->insert_batch('anggotapenelitian', $agtpenelitian);
                // $builder = $this->db->table('anggota_penelitian');
                // $builder->insertBatch($agtpenelitian);





                // if ($this->db->affectedRows() > 0) {
                //     return TRUE;
                // }
                // return FALSE;

                //  
                // $agtpenelitian = $this->db->insertID();
                // $this->anggotapenelitian->insert([
                //     'id_penelitian' => $idpenelitian,
                //     'nidn' => $idpenelitian

                // ]);

                //GET ID PACKAGE




                $result = [
                    'success' => 'Data has been added to database'
                ];
            }
            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }


    public function get_hki_edit()
    {
        if ($this->request->isAJAX()) {
            $id_hki = $this->request->getVar('id_hki');
            // $dosenlist = $dosen->select('nidn,nama_dosen')->like('nama_dosen', $search)->findAll(10);
            // $row = $this->dosen->find($nidn);
            // $query = "SELECT penelitian.*, dosen.*
            // FROM penelitian
            // JOIN dosen ON penelitian.nidn_ketua = dosen.nidn";
            // $row = $this->penelitian->find($id_penelitian);




            $builder = $this->db->table('hki');
            $builder->select('*');
            $builder->join('dosen', 'hki.nidn_hki = dosen.nidn');
            $builder->where('id_hki', $id_hki);
            $query = $builder->get();

            foreach ($query->getResultArray() as $row) {
                $data = [
                    'id_hki' => $row['id_hki'],
                    'nama_dosen' => $row['nama_dosen'],
                    'nidn_hki' => $row['nidn_hki'],
                    'judul_hki' => $row['judul_hki'],
                    'jenis_hki' => $row['jenis_hki'],
                    'no_pendaftaran' => $row['no_pendaftaran'],
                    'status_hki' => $row['status_hki'],
                    'no_hki' => $row['no_hki'],
                    'kd_sts_berkas_hki' => $row['kd_sts_berkas_hki'],
                    'keterangan_invalid' => $row['keterangan_invalid']
                ];
            }


            // foreach ($query->getResultArray() as $row) {
            //     $data = [
            //         // 'id_penelitian' => $row->id_penelitian,
            //         // 'nama_dosen' => $row->nama_dosen,
            //         // 'nidn' => $row->nidn,
            //         // 'nama_anggota' => $row->nama_anggota,
            //         // 'judul_penelitian' => $row->judul_penelitian,
            //         // 'nama_skema' => $row->nama_skema,
            //         // 'jumlah_dana' => $row->jumlah_dana,
            //         // 'tahun_penelitian' => $row->tahun_penelitian,
            //         // 'bidang_penelitian' => $row->bidang_penelitian,
            //         // 'bidang_penelitian_lain' => $row->bidang_penelitian_lain,
            //         // 'tujuan_sosial_ekonomi' => $row->tujuan_sosial_ekonomi,
            //         // 'tujuan_sosial_ekonomi_lain' => $row->tujuan_sosial_ekonomi_lain

            //         'id_penelitian' => $row['id_penelitian'],
            //         'nama_dosen' => $row['nama_dosen'],
            //         'nidn' => $row['nidn'],
            //         'nama_anggota' => $row['nama_anggota'],
            //         'judul_penelitian' => $row['judul_penelitian'],
            //         'nama_skema' => $row['nama_skema'],
            //         'jumlah_dana' => $row['jumlah_dana'],
            //         'tahun_penelitian' => $row['tahun_penelitian'],
            //         'bidang_penelitian' => $row['bidang_penelitian'],
            //         'bidang_penelitian_lain' => $row['bidang_penelitian_lain'],
            //         'tujuan_sosial_ekonomi' => $row['tujuan_sosial_ekonomi'],
            //         'tujuan_sosial_ekonomi_lain' => $row['tujuan_sosial_ekonomi_lain']
            //     ];
            // }

            // $agtnama = [];
            // $agtnidn = [];

            // $query = $this->db->query(" SELECT dosen.nama_dosen, anggota_penelitian.nidn
            // FROM dosen
            // JOIN anggota_penelitian ON dosen.nidn = anggota_penelitian.nidn
            // WHERE anggota_penelitian.id_pen = $id_penelitian;");
            // // $builder = $this->db->table('dosen');
            // // $builder->join('anggota_penelitian', 'dosen.nidn = anggota_penelitian.nidn');
            // // $builder->select('dosen.nama_dosen');
            // // $builder->where('anggota_penelitian.id_pen', $d);
            // // $query = $builder->get()->getResultArray();
            // // $query = $builder->get();
            // // $data = $query->getResultArray();
            // // $agt = [];
            // foreach ($query->getResultArray() as $row) {
            //     $agtnama[] = $row['nama_dosen'];
            //     $agtnidn[] = $row['nidn']; // untuk  memisahkan antara setiap anggota (. ", ")



            // }






            // $queryagt = $this->db->query(" SELECT nidn
            // FROM anggota_penelitian
            // -- JOIN anggota_penelitian ON dosen.nidn = anggota_penelitian.nidn
            // WHERE id_pen = $id_penelitian;");
            // // $builder = $this->db->table('dosen');
            // // $builder->join('anggota_penelitian', 'dosen.nidn = anggota_penelitian.nidn');
            // // $builder->select('dosen.nama_dosen');
            // // $builder->where('anggota_penelitian.id_pen', $d);
            // // $query = $builder->get()->getResultArray();
            // // $query = $builder->get();
            // // $data = $query->getResultArray();
            // $agt = [];
            // foreach ($queryagt as $row) {
            //     $agt[] = $row['nidn']; // untuk  memisahkan antara setiap anggota (. ", ")



            // }

            // $data = [
            //     'nidn' => $row['nidn'],
            //     'nama_dosen' => $row['nama_dosen'],
            //     'gelar' => $row['gelar'],
            //     'nip' => $row['nip'],
            //     'jekel' => $row['jekel'],
            //     'jabatan_akademik' => $row['jabatan_akademik'],
            //     'program_studi' => $row['program_studi'],
            //     'password' => $row['password'],
            //     'password_confirm' => $row['password']
            // ];

            $result = [
                'output' => view('pages/modals/hki/edit_hki', $data)
            ];

            return json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }

    public function update_data()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();


            //niprule_is_unique

            $rules = $this->validate([
                'nidn_hki' => [
                    'label' => 'nidn_hki',
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided',
                        'min_length' => 'Minimal 3 huruf',
                    ],
                ],

                'judul_hki' => [
                    'label' => 'judul_hki',
                    'rules' => 'required|min_length[3]',
                ],

            ]);

            if (!$rules) {
                $result = [
                    'error' => [
                        'nidn_hki' => $validation->getError('nidn_hki'),
                        'judul_hki' => $validation->getError('judul_hki'),
                        //     'jekel' => $validation->getError('jekel'),
                        //     'program_studi' => $validation->getError('program_studi'),
                        //     'password' => $validation->getError('password'),
                        //     'password_confirm' => $validation->getError('password_confirm')
                    ]
                ];
            } else {
                // if ($this->request->getPost('nidn') == null) {
                //     return view('pages/admin/u_dosen/index');
                // }

                $id_hki = $this->request->getPost('id_hki');

                $this->hki->update($id_hki, [
                    'nidn_hki' => strip_tags($this->request->getPost('nidn_hki')),
                    // 'nama_dosen' => strip_tags($this->request->getPost('nama_dosen')),
                    'judul_hki' => strip_tags($this->request->getPost('judul_hki')),
                    'jenis_hki' => strip_tags($this->request->getPost('jenis_hki')),
                    'no_pendaftaran' => strip_tags($this->request->getPost('no_pendaftaran')),
                    'status_hki' => strip_tags($this->request->getPost('status_hki')),
                    'no_hki' => strip_tags($this->request->getPost('no_hki')),
                    'kd_sts_berkas_hki' => strip_tags($this->request->getPost('kd_sts_berkas_hki')),
                    'keterangan_invalid' => strip_tags($this->request->getPost('keterangan_invalid'))


                ]);

                // if ($this->db->affectedRows() > 0) {
                //     return TRUE;
                // }
                // return FALSE;

                //  
                // $agtpenelitian = $this->db->insertID();
                // $this->anggotapenelitian->insert([
                //     'id_penelitian' => $idpenelitian,
                //     'nidn' => $idpenelitian

                // ]);

                //GET ID PACKAGE




                $result = [
                    'success' => 'Data has been added to database'
                ];
            }
            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }



    public function delete_data()
    {
        if ($this->request->isAJAX()) {
            $id_hki = $this->request->getVar('id_hki');

            $this->hki->delete($id_hki);

            $result = [
                'output' => "Data HKI berhasil dihapus"
            ];

            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }
}
