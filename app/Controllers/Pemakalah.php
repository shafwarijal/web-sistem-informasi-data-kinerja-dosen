<?php

namespace App\Controllers;

use App\Models\Penelitian_model;
use App\Models\Dosen_model;
use App\Models\Anggota_model;
use App\Models\Pemakalah_model;

class Pemakalah extends BaseController
{

    public function __construct()
    {
        require_once APPPATH . 'ThirdParty/ssp.class.php';
        $this->db = db_connect();
        $this->penelitian = new Penelitian_model();
        $this->dosen = new Dosen_model();
        $this->anggotapenelitian = new Anggota_model();
        $this->pemakalah = new Pemakalah_model();
        helper('form');
    }

    public function index()
    {
        if (session()->get('role') == "1") {
            return view('pages/admin/a_pemakalah/index');
        } elseif (session()->get('role') == "2") {
            return view('pages/user/u_pemakalah/index');
        } else {
            exit('404 Not Found');
        }
    }

    public function get_pemakalah()
    {
        if ($this->request->isAJAX()) {
            if (session()->get('role') == "1") {
                $result = [
                    'output' => view('pages/admin/a_pemakalah/list_pemakalah')
                ];

                echo json_encode($result);
            } elseif (session()->get('role') == "2") {
                $page = (isset($_POST['page'])) ? $_POST['page'] : 1;

                $limit = 5;
                $limit_start = ($page - 1) * $limit;
                $no = $limit_start + 1;

                $s_status = "";
                $s_search = "";



                if (isset($_POST['status'])) {
                    $s_status = $_POST['status'];
                    $s_search = $_POST['search'];
                }


                $query = $this->db->query("SELECT pemakalah.*, dosen.*
                FROM pemakalah
                JOIN dosen ON pemakalah.nidn_pem = dosen.nidn
                WHERE 
                status_pemakalah LIKE '%$s_status%' AND
                (nama_dosen LIKE '%$s_search%' OR
                judul_makalah LIKE '%$s_search%' OR
                nama_forum LIKE '%$s_search%' OR
                tahun_pemakalah LIKE '%$s_search%' OR
                institusi_penyelenggara LIKE '%$s_search%')
                ORDER BY nama_dosen ASC LIMIT $limit_start, $limit");

                $jmlData =  $this->db->query("SELECT count(*) as jumlah
                FROM pemakalah
                JOIN dosen ON pemakalah.nidn_pem = dosen.nidn
                WHERE 
                status_pemakalah LIKE '%$s_status%' AND
                (nama_dosen LIKE '%$s_search%' OR
                judul_makalah LIKE '%$s_search%' OR
                nama_forum LIKE '%$s_search%' OR
                tahun_pemakalah LIKE '%$s_search%' OR
                institusi_penyelenggara LIKE '%$s_search%')");

                $data = [
                    'data_pemakalah' => $query,
                    'total' => $jmlData,


                ];
                return view('pages/user/u_pemakalah/list_pemakalah', $data);
            }
        } else {
            exit('404 Not Found');
        }
    }



    public function getAllpemakalah()
    {


        $table = <<<EOT
        (
            SELECT pemakalah.*, dosen.*
            FROM pemakalah
            JOIN dosen ON pemakalah.nidn_pem = dosen.nidn
        ) temp
    EOT;

        $primaryKey = 'id_pemakalah';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array('db' => 'nidn_pem', 'dt' => 1),
            array('db' => 'nama_dosen',  'dt' => 2),
            array('db' => 'status_pemakalah',     'dt' => 3),
            array('db' => 'judul_makalah',     'dt' => 4),
            array('db' => 'nama_forum',     'dt' => 5),
            array('db' => 'institusi_penyelenggara',     'dt' => 6),
            array('db' => 'tgl_mulai_pelaksanaan',     'dt' => 7),
            array('db' => 'tgl_akhir_pelaksanaan',     'dt' => 8),
            array('db' => 'tempat_pelaksanaan',     'dt' => 9),
            array('db' => 'kd_sts_berkas_makalah',     'dt' => 10),
            array('db' => 'keterangan_invalid',     'dt' => 11),
            array('db' => 'tahun_pemakalah',     'dt' => 12),
            array('db' => 'tingkat',     'dt' => 13),
            array('db' => 'id_pemakalah',     'dt' => 14),
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

    public function get_add_pemakalah()
    {
        if ($this->request->isAJAX()) {
            $result = [
                'output' => view('pages/modals/pemakalah/add_pemakalah')
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
                'nidn' => [
                    'label' => 'nidn dosen',
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided',
                        'min_length' => 'Minimal 3 huruf',
                    ],
                ],

                'judul_makalah' => [
                    'label' => 'judul_penelitian',
                    'rules' => 'required|min_length[3]',
                ],

            ]);

            if (!$rules) {
                $result = [
                    'error' => [
                        'nidn' => $validation->getError('nidn'),
                        'judul_makalah' => $validation->getError('judul_makalah'),

                    ]
                ];
            } else {


                $this->pemakalah->insert([
                    'nidn_pem' => strip_tags($this->request->getPost('nidn')),

                    'status_pemakalah' => strip_tags($this->request->getPost('status_pemakalah')),
                    'judul_makalah' => strip_tags($this->request->getPost('judul_makalah')),
                    'nama_forum' => strip_tags($this->request->getPost('nama_forum')),
                    'institusi_penyelenggara' => strip_tags($this->request->getPost('institusi_penyelenggara')),
                    'tgl_mulai_pelaksanaan' => strip_tags($this->request->getPost('tgl_mulai_pelaksanaan')),
                    'tgl_akhir_pelaksanaan' => strip_tags($this->request->getPost('tgl_akhir_pelaksanaan')),
                    'kd_sts_berkas_makalah' => strip_tags($this->request->getPost('kd_sts_berkas_makalah')),
                    'keterangan_invalid' => strip_tags($this->request->getPost('keterangan_invalid')),
                    'tempat_pelaksanaan' => strip_tags($this->request->getPost('tempat_pelaksanaan')),
                    'tahun_pemakalah' => strip_tags($this->request->getPost('tahun_pemakalah')),
                    'tingkat' => strip_tags($this->request->getPost('tingkat')),
                ]);
                $result = [
                    'success' => 'Data pemakalah berhasil ditambah'
                ];
            }
            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }


    public function get_pemakalah_edit()
    {
        if ($this->request->isAJAX()) {
            $id_pemakalah = $this->request->getVar('id_pemakalah');


            $builder = $this->db->table('pemakalah');
            $builder->select('*');
            $builder->join('dosen', 'pemakalah.nidn_pem = dosen.nidn');
            $builder->where('id_pemakalah', $id_pemakalah);
            $query = $builder->get();

            foreach ($query->getResultArray() as $row) {
                $data = [
                    'id_pemakalah' => $row['id_pemakalah'],
                    'nama_dosen' => $row['nama_dosen'],
                    'nidn' => $row['nidn'],
                    'status_pemakalah' => $row['status_pemakalah'],
                    'judul_makalah' => $row['judul_makalah'],
                    'nama_forum' => $row['nama_forum'],
                    'institusi_penyelenggara' => $row['institusi_penyelenggara'],
                    'tgl_mulai_pelaksanaan' => $row['tgl_mulai_pelaksanaan'],
                    'tgl_akhir_pelaksanaan' => $row['tgl_akhir_pelaksanaan'],
                    'kd_sts_berkas_makalah' => $row['kd_sts_berkas_makalah'],
                    'keterangan_invalid' => $row['keterangan_invalid'],
                    'tempat_pelaksanaan' => $row['tempat_pelaksanaan'],
                    'tahun_pemakalah' => $row['tahun_pemakalah'],
                    'tingkat' => $row['tingkat'],

                ];
            }


            $result = [
                'output' => view('pages/modals/pemakalah/edit_pemakalah', $data)
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




            $rules = $this->validate([
                'nidn' => [
                    'label' => 'nidn dosen',
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided',
                        'min_length' => 'Minimal 3 huruf',
                    ],
                ],

                'judul_makalah' => [
                    'label' => 'judul_makalah',
                    'rules' => 'required|min_length[3]',
                ],

            ]);

            if (!$rules) {
                $result = [
                    'error' => [
                        'nidn' => $validation->getError('nidn'),
                        'judul_makalah' => $validation->getError('judul_makalah'),

                    ]
                ];
            } else {

                $id_pemakalah = $this->request->getPost('id_pemakalah');

                $this->pemakalah->update($id_pemakalah, [
                    'nidn_pem' => strip_tags($this->request->getPost('nidn')),
                    // 'nama_dosen' => strip_tags($this->request->getPost('nama_dosen')),
                    'status_pemakalah' => strip_tags($this->request->getPost('status_pemakalah')),
                    'judul_makalah' => strip_tags($this->request->getPost('judul_makalah')),
                    'nama_forum' => strip_tags($this->request->getPost('nama_forum')),
                    'institusi_penyelenggara' => strip_tags($this->request->getPost('institusi_penyelenggara')),
                    'tgl_mulai_pelaksanaan' => strip_tags($this->request->getPost('tgl_mulai_pelaksanaan')),
                    'tgl_akhir_pelaksanaan' => strip_tags($this->request->getPost('tgl_akhir_pelaksanaan')),
                    'kd_sts_berkas_makalah' => strip_tags($this->request->getPost('kd_sts_berkas_makalah')),
                    'keterangan_invalid' => strip_tags($this->request->getPost('keterangan_invalid')),
                    'tempat_pelaksanaan' => strip_tags($this->request->getPost('tempat_pelaksanaan')),
                    'tahun_pemakalah' => strip_tags($this->request->getPost('tahun_pemakalah')),
                    'tingkat' => strip_tags($this->request->getPost('tingkat')),

                ]);


                $result = [
                    'success' => 'Data pemakalah berhasil diperbarui'
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
            $id_pemakalah = $this->request->getVar('id_pemakalah');

            $this->pemakalah->delete($id_pemakalah);

            $result = [
                'output' => "Data penelitian berhasil dihapus"
            ];

            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }
}
