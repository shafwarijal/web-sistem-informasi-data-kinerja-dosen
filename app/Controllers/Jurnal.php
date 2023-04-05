<?php

namespace App\Controllers;

use App\Models\Penelitian_model;
use App\Models\Dosen_model;
use App\Models\Anggota_model;
use App\Models\Pemakalah_model;
use App\Models\Jurnal_model;

class Jurnal extends BaseController
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

        helper('form');
    }

    public function index()
    {
        if (session()->get('role') == "1") {
            return view('pages/admin/a_jurnal/index');
        } elseif (session()->get('role') == "2") {
            return view('pages/user/u_jurnal/index');
        } else {
            exit('404 Not Found');
        }
    }

    public function get_jurnal_detail()
    {
        if ($this->request->isAJAX()) {

            $result = [
                'output' => view('pages/admin/a_jurnal/list_jurnal')
            ];

            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }



    public function get_jurnal()
    {
        if ($this->request->isAJAX()) {
            if (session()->get('role') == "1") {
                $result = [
                    'output' => view('pages/admin/a_jurnal/list_jurnal')
                ];

                echo json_encode($result);
            } elseif (session()->get('role') == "2") {

                $page = (isset($_POST['page'])) ? $_POST['page'] : 1;

                $limit = 5;
                $limit_start = ($page - 1) * $limit;
                $no = $limit_start + 1;

                $s_tingkat = "";
                $s_search = "";



                if (isset($_POST['tingkat'])) {
                    $s_tingkat = $_POST['tingkat'];
                    $s_search = $_POST['search'];
                }


                $query = $this->db->query("SELECT *
                FROM jurnal
                WHERE 
                tingkat LIKE '%$s_tingkat%' AND
                (judul_jurnal LIKE '%$s_search%' OR
                nama_jurnal LIKE '%$s_search%' OR
                nama_personil LIKE '%$s_search%' OR
                tahun_jurnal LIKE '%$s_search%' OR
                issn LIKE '%$s_search%')
                ORDER BY id_jurnal ASC LIMIT $limit_start, $limit");


                $jmlData =  $this->db->query("SELECT count(*) as jumlah
                FROM jurnal
                WHERE 
                tingkat LIKE '%$s_tingkat%' AND
                (judul_jurnal LIKE '%$s_search%' OR
                nama_jurnal LIKE '%$s_search%' OR
                nama_personil LIKE '%$s_search%' OR
                tahun_jurnal LIKE '%$s_search%' OR
                issn LIKE '%$s_search%')");


                $data = [
                    'data_jurnal' => $query,
                    'total' => $jmlData,


                ];
                return view('pages/user/u_jurnal/list_jurnal', $data);
            }
        } else {
            exit('404 Not Found');
        }
    }



    public function getAlljurnal()
    {


        $table = 'jurnal';


        // Table's primary key
        $primaryKey = 'id_jurnal';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array('db' => 'judul_jurnal', 'dt' => 1),
            array('db' => 'nama_jurnal',  'dt' => 2),
            array('db' => 'nama_personil',     'dt' => 3),
            array('db' => 'issn',     'dt' => 4),
            array('db' => 'volume',     'dt' => 5),
            array('db' => 'nomor1',     'dt' => 6),
            array('db' => 'halaman_awal',     'dt' => 7),
            array('db' => 'halaman_akhir',     'dt' => 8),
            array('db' => 'status_akreditasi',     'dt' => 9),
            array('db' => 'tingkat',     'dt' => 10),
            array('db' => 'tahun_jurnal',     'dt' => 11),
            array('db' => 'url',     'dt' => 12),
            array('db' => 'id_jurnal',     'dt' => 13),
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

    public function get_add_jurnal()
    {
        if ($this->request->isAJAX()) {
            $result = [
                'output' => view('pages/modals/jurnal/add_jurnal')
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




    public function save_data()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();


            //niprule_is_unique

            $rules = $this->validate([
                'judul_jurnal' => [
                    'label' => 'judul_jurnal',
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided',
                        'min_length' => 'Minimal 3 huruf',
                    ],
                ],

                'issn' => [
                    'label' => 'issn',
                    'rules' => 'required|min_length[1]',
                ],

            ]);

            if (!$rules) {
                $result = [
                    'error' => [
                        'judul_jurnal' => $validation->getError('judul_jurnal'),
                        'issn' => $validation->getError('issn'),

                    ]
                ];
            } else {
                // if ($this->request->getPost('nidn') == null) {
                //     return view('pages/admin/u_dosen/index');
                // }

                $this->jurnal->insert([
                    'judul_jurnal' => strip_tags($this->request->getPost('judul_jurnal')),
                    // 'nama_dosen' => strip_tags($this->request->getPost('nama_dosen')),
                    'nama_jurnal' => strip_tags($this->request->getPost('nama_jurnal')),
                    'nama_personil' => strip_tags($this->request->getPost('nama_personil')),
                    'issn' => strip_tags($this->request->getPost('issn')),
                    'volume' => strip_tags($this->request->getPost('volume')),
                    'nomor1' => strip_tags($this->request->getPost('nomor1')),
                    'halaman_awal' => strip_tags($this->request->getPost('halaman_awal')),
                    'halaman_akhir' => strip_tags($this->request->getPost('halaman_akhir')),
                    'status_akreditasi' => strip_tags($this->request->getPost('status_akreditasi')),
                    'tingkat' => strip_tags($this->request->getPost('tingkat')),
                    'tahun_jurnal' => strip_tags($this->request->getPost('tahun_jurnal')),
                    'url' => strip_tags($this->request->getPost('url')),

                ]);






                $result = [
                    'success' => 'Data has been added to database'
                ];
            }
            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }


    public function get_jurnal_edit()
    {
        if ($this->request->isAJAX()) {
            $id_jurnal = $this->request->getVar('id_jurnal');

            $row = $this->jurnal->find($id_jurnal);


            $data = [
                'id_jurnal' => $row['id_jurnal'],
                'judul_jurnal' => $row['judul_jurnal'],
                'nama_jurnal' => $row['nama_jurnal'],
                'nama_personil' => $row['nama_personil'],
                'issn' => $row['issn'],
                'volume' => $row['volume'],
                'nomor1' => $row['nomor1'],
                'halaman_awal' => $row['halaman_awal'],
                'halaman_akhir' => $row['halaman_akhir'],
                'status_akreditasi' => $row['status_akreditasi'],
                'tingkat' => $row['tingkat'],
                'tahun_jurnal' => $row['tahun_jurnal'],
                'url' => $row['url'],
            ];



            $result = [
                'output' => view('pages/modals/jurnal/edit_jurnal', $data)
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
                'judul_jurnal' => [
                    'label' => 'judul_jurnal',
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided',
                        'min_length' => 'Minimal 3 huruf',
                    ],
                ],

                'issn' => [
                    'label' => 'issn',
                    'rules' => 'required|min_length[1]',
                ],

            ]);

            if (!$rules) {
                $result = [
                    'error' => [
                        'judul_jurnal' => $validation->getError('judul_jurnal'),
                        'issn' => $validation->getError('issn'),

                    ]
                ];
            } else {

                $id_jurnal = $this->request->getPost('id_jurnal');

                $this->jurnal->update($id_jurnal, [
                    'judul_jurnal' => strip_tags($this->request->getPost('judul_jurnal')),
                    // 'nama_dosen' => strip_tags($this->request->getPost('nama_dosen')),
                    'nama_jurnal' => strip_tags($this->request->getPost('nama_jurnal')),
                    'nama_personil' => strip_tags($this->request->getPost('nama_personil')),
                    'issn' => strip_tags($this->request->getPost('issn')),
                    'volume' => strip_tags($this->request->getPost('volume')),
                    'nomor1' => strip_tags($this->request->getPost('nomor1')),
                    'halaman_awal' => strip_tags($this->request->getPost('halaman_awal')),
                    'halaman_akhir' => strip_tags($this->request->getPost('halaman_akhir')),
                    'status_akreditasi' => strip_tags($this->request->getPost('status_akreditasi')),
                    'tingkat' => strip_tags($this->request->getPost('tingkat')),
                    'tahun_jurnal' => strip_tags($this->request->getPost('tahun_jurnal')),
                    'url' => strip_tags($this->request->getPost('url')),

                ]);





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
            $id_jurnal = $this->request->getVar('id_jurnal');

            $this->jurnal->delete($id_jurnal);

            $result = [
                'output' => "Data penelitian berhasil dihapus"
            ];

            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }
}
