<?php

namespace App\Controllers;

use App\Models\Penelitian_model;
use App\Models\Dosen_model;
use App\Models\Anggota_model;

class Penelitian extends BaseController
{

    public function __construct()
    {
        require_once APPPATH . 'ThirdParty/ssp.class.php';
        $this->db = db_connect();
        $this->penelitian = new Penelitian_model();
        $this->dosen = new Dosen_model();
        $this->anggotapenelitian = new Anggota_model();
        helper('form');
    }

    public function index()
    {
        if (session()->get('role') == "1") {
            return view('pages/admin/a_penelitian/index');
        } elseif (session()->get('role') == "2") {
            return view('pages/user/u_penelitian/index');
        } else {
            exit('404 Not Found');
        }
    }


    public function get_penelitian()
    {
        if ($this->request->isAJAX()) {

            if (session()->get('role') == "1") {
                $result = [
                    'output' => view('pages/admin/a_penelitian/list_penelitian')
                ];

                echo json_encode($result);
            } elseif (session()->get('role') == "2") {

                $page = (isset($_POST['page'])) ? $_POST['page'] : 1;

                $limit = 5;
                $limit_start = ($page - 1) * $limit;
                $no = $limit_start + 1;

                $s_search = "";
                $s_skema = "";


                if (isset($_POST['skema'])) {
                    $s_skema = $_POST['skema'];
                    $s_search = $_POST['search'];
                }


                $query = $this->db->query("SELECT penelitian.*, dosen.*, agt.*
                FROM penelitian 
                JOIN dosen ON penelitian.nidn_ketua = dosen.nidn
                LEFT JOIN (SELECT anggota_penelitian.id_pen, GROUP_CONCAT(dosen.nama_dosen SEPARATOR ', ') as nama_agt 
                FROM anggota_penelitian
                JOIN dosen ON anggota_penelitian.nidn = dosen.nidn
                GROUP BY anggota_penelitian.id_pen) agt ON penelitian.id_penelitian = agt.id_pen 
                WHERE 
                nama_skema LIKE '%$s_skema%' AND
                (nama_dosen LIKE '%$s_search%' OR
                judul_penelitian LIKE '%$s_search%' OR
                nama_agt LIKE '%$s_search%' OR
                bidang_penelitian LIKE '%$s_search%' OR
                tahun_penelitian LIKE '%$s_search%' OR
                bidang_penelitian_lain LIKE '%$s_search%')
                ORDER BY nama_dosen ASC LIMIT $limit_start, $limit");

                $jmlData =  $this->db->query("SELECT count(*) as jumlah
                FROM penelitian 
                JOIN dosen ON penelitian.nidn_ketua = dosen.nidn
                LEFT JOIN (SELECT anggota_penelitian.id_pen, GROUP_CONCAT(dosen.nama_dosen SEPARATOR ', ') as nama_agt 
                FROM anggota_penelitian
                JOIN dosen ON anggota_penelitian.nidn = dosen.nidn
                GROUP BY anggota_penelitian.id_pen) agt ON penelitian.id_penelitian = agt.id_pen 
                WHERE 
                nama_skema LIKE '%$s_skema%' AND
                (nama_dosen LIKE '%$s_search%' OR
                judul_penelitian LIKE '%$s_search%' OR
                nama_agt LIKE '%$s_search%' OR
                bidang_penelitian LIKE '%$s_search%' OR
                tahun_penelitian LIKE '%$s_search%' OR
                bidang_penelitian_lain LIKE '%$s_search%')");

                $data = [
                    'data_penelitian' => $query,
                    'total' => $jmlData,


                ];
                return view('pages/user/u_penelitian/list_penelitian', $data);
            }
        } else {
            exit('404 Not Found');
        }
    }



    public function getAllpenelitian()
    {


        $table = <<< EOT
        (
            SELECT penelitian.*, dosen.*, agt.*
            FROM penelitian 
            JOIN dosen ON penelitian.nidn_ketua = dosen.nidn
            LEFT JOIN (SELECT anggota_penelitian.id_pen, GROUP_CONCAT(dosen.nama_dosen SEPARATOR ', ') as nama_agt 
            FROM anggota_penelitian
            JOIN dosen ON anggota_penelitian.nidn = dosen.nidn
            GROUP BY anggota_penelitian.id_pen) agt ON penelitian.id_penelitian = agt.id_pen
        ) temp
        EOT;

        $primaryKey = 'id_penelitian';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array('db' => 'nidn_ketua', 'dt' => 1),
            array('db' => 'nama_dosen',  'dt' => 2),
            array('db' => 'nama_agt',   'dt' => 3),
            array('db' => 'judul_penelitian',     'dt' => 4),
            array('db' => 'nama_skema',     'dt' => 5),
            array('db' => 'jumlah_dana',     'dt' => 6),
            array('db' => 'tahun_penelitian',     'dt' => 7),
            array('db' => 'bidang_penelitian',     'dt' => 8),
            array('db' => 'bidang_penelitian_lain',     'dt' => 9),
            array('db' => 'tujuan_sosial_ekonomi',     'dt' => 10),
            array('db' => 'tujuan_sosial_ekonomi_lain',     'dt' => 11),
            array('db' => 'id_penelitian',     'dt' => 12),
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

    public function get_add_penelitian()
    {
        if ($this->request->isAJAX()) {


            $result = [
                'output' => view('pages/modals/penelitian/add_penelitian')
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
        $dosenlist = $dosen->select('nidn,nama_dosen')->like('nama_dosen', $search)->orderBy('nama_dosen')->findAll(10);
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
                'nidn' => [
                    'label' => 'nidn dosen',
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided',
                        'min_length' => 'Minimal 3 huruf',
                    ],
                ],

                'judul_penelitian' => [
                    'label' => 'judul_penelitian',
                    'rules' => 'required|min_length[3]',
                ],

            ]);

            if (!$rules) {
                $result = [
                    'error' => [
                        'nidn' => $validation->getError('nidn'),
                        'judul_penelitian' => $validation->getError('judul_penelitian'),

                    ]
                ];
            } else {

                $this->penelitian->insert([
                    'nidn_ketua' => strip_tags($this->request->getPost('nidn')),
                    // 'nama_dosen' => strip_tags($this->request->getPost('nama_dosen')),
                    'judul_penelitian' => strip_tags($this->request->getPost('judul_penelitian')),
                    'nama_skema' => strip_tags($this->request->getPost('nama_skema')),
                    'jumlah_dana' => strip_tags($this->request->getPost('jumlah_dana')),
                    'tahun_penelitian' => strip_tags($this->request->getPost('tahun_penelitian')),
                    'bidang_penelitian' => strip_tags($this->request->getPost('bidang_penelitian')),
                    'bidang_penelitian_lain' => strip_tags($this->request->getPost('bidang_penelitian_lain')),
                    'tujuan_sosial_ekonomi' => strip_tags($this->request->getPost('tujuan_sosial_ekonomi')),
                    'tujuan_sosial_ekonomi_lain' => strip_tags($this->request->getPost('tujuan_sosial_ekonomi_lain')),

                ]);

                // $idpenelitian = $data_penelitian->insertID();
                $idpenelitian = $this->db->insertID();

                $nama_anggota = $this->request->getPost('nama_anggota[]');
                $agtpenelitian = array();
                foreach ($nama_anggota as $key) {
                    $agtpenelitian[] = array(
                        'id_pen' => $idpenelitian,
                        'nidn' => $key
                    );
                }


                $this->anggotapenelitian->insertBatch($agtpenelitian);






                $result = [
                    'success' => 'Data penelitian berhasil ditambah'
                ];
            }
            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }


    public function get_penelitian_edit()
    {
        if ($this->request->isAJAX()) {
            $id_penelitian = $this->request->getVar('id_penelitian');



            $agt = '';
            // $agtnama = '';
            // $agtnidn = '';

            $query = $this->db->query(" SELECT dosen.nama_dosen, anggota_penelitian.nidn
            FROM dosen
            JOIN anggota_penelitian ON dosen.nidn = anggota_penelitian.nidn
            WHERE anggota_penelitian.id_pen = $id_penelitian;");
            foreach ($query->getResultArray() as $row) {
                // $agtnama .= $row['nama_dosen'];
                // $agtnidn .= $row['nidn'];
                $agt .= '<option value="' . $row['nidn'] . '" selected>' . $row['nama_dosen'] . '</option>';
            }

            $builder = $this->db->table('penelitian');
            $builder->select('*');
            $builder->join('dosen', 'penelitian.nidn_ketua = dosen.nidn');
            $builder->where('id_penelitian', $id_penelitian);
            $query = $builder->get();

            foreach ($query->getResultArray() as $row) {
                $data = [
                    'id_penelitian' => $row['id_penelitian'],
                    'nama_dosen' => $row['nama_dosen'],
                    'nidn' => $row['nidn'],
                    //'nama_anggota' => $row['nama_anggota'],
                    'judul_penelitian' => $row['judul_penelitian'],
                    'nama_skema' => $row['nama_skema'],
                    'jumlah_dana' => $row['jumlah_dana'],
                    'tahun_penelitian' => $row['tahun_penelitian'],
                    'bidang_penelitian' => $row['bidang_penelitian'],
                    'bidang_penelitian_lain' => $row['bidang_penelitian_lain'],
                    'tujuan_sosial_ekonomi' => $row['tujuan_sosial_ekonomi'],
                    'tujuan_sosial_ekonomi_lain' => $row['tujuan_sosial_ekonomi_lain'],
                    'nama_anggota' => $agt
                ];
            }



            $result = [
                'output' => view('pages/modals/penelitian/edit_penelitian', $data)
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
                'nidn' => [
                    'label' => 'nidn dosen',
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided',
                        'min_length' => 'Minimal 3 huruf',
                    ],
                ],

                'judul_penelitian' => [
                    'label' => 'judul_penelitian',
                    'rules' => 'required|min_length[3]',
                ],

            ]);

            if (!$rules) {
                $result = [
                    'error' => [
                        'nidn' => $validation->getError('nidn'),
                        'judul_penelitian' => $validation->getError('judul_penelitian'),
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
                $id_penelitian = $this->request->getPost('id_penelitian');

                $this->penelitian->update($id_penelitian, [
                    'nidn_ketua' => strip_tags($this->request->getPost('nidn')),
                    // 'nama_dosen' => strip_tags($this->request->getPost('nama_dosen')),
                    'judul_penelitian' => strip_tags($this->request->getPost('judul_penelitian')),
                    'nama_skema' => strip_tags($this->request->getPost('nama_skema')),
                    'jumlah_dana' => strip_tags($this->request->getPost('jumlah_dana')),
                    'tahun_penelitian' => strip_tags($this->request->getPost('tahun_penelitian')),
                    'bidang_penelitian' => strip_tags($this->request->getPost('bidang_penelitian')),
                    'bidang_penelitian_lain' => strip_tags($this->request->getPost('bidang_penelitian_lain')),
                    'tujuan_sosial_ekonomi' => strip_tags($this->request->getPost('tujuan_sosial_ekonomi')),
                    'tujuan_sosial_ekonomi_lain' => strip_tags($this->request->getPost('tujuan_sosial_ekonomi_lain')),

                ]);

                // $idpenelitian = $data_penelitian->insertID();
                // $idpenelitian = $this->db->insertID();


                // $this->anggotapenelitian->delete(array('id_pen' => $id_penelitian));
                $this->anggotapenelitian->where('id_pen', $id_penelitian);
                $this->anggotapenelitian->delete();

                $nama_anggota = $this->request->getPost('nama_anggota[]');
                $agtpenelitian = array();
                foreach ($nama_anggota as $key) {
                    $agtpenelitian[] = array(
                        'id_pen' => $id_penelitian,
                        'nidn' =>  $key
                    );
                }

                // $this->db->insert_batch('anggotapenelitian', $agtpenelitian);

                $this->anggotapenelitian->insertBatch($agtpenelitian);


                $result = [
                    'success' => 'Data penelitian berhasil diperbarui'
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
            $id_penelitian = $this->request->getVar('id_penelitian');

            $this->penelitian->delete($id_penelitian);

            $result = [
                'output' => "Data penelitian berhasil dihapus"
            ];

            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }
}
