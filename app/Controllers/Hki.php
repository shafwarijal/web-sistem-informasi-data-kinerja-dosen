<?php

namespace App\Controllers;

use App\Models\Penelitian_model;
use App\Models\Dosen_model;
use App\Models\Anggota_model;
use App\Models\Pemakalah_model;
use App\Models\Jurnal_model;
use App\Models\Hki_model;

class Hki extends BaseController
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
            return view('pages/admin/a_hki/index');
        } elseif (session()->get('role') == "2") {
            return view('pages/user/u_hki/index');
        } else {
            exit('404 Not Found');
        }
    }


    public function get_hki()
    {
        if ($this->request->isAJAX()) {
            if (session()->get('role') == "1") {
                $result = [
                    'output' => view('pages/admin/a_hki/list_hki')
                ];

                echo json_encode($result);
            } elseif (session()->get('role') == "2") {

                // FROM dosen
                // JOIN anggota_penelitian ON dosen.nidn = anggota_penelitian.nidn
                // WHERE anggota_penelitian.id_pen = $d;");
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
            array('db' => 'tahun_hki',     'dt' => 8),
            array('db' => 'kd_sts_berkas_hki',     'dt' => 9),
            array('db' => 'keterangan_invalid',     'dt' => 10),
            array('db' => 'id_hki',     'dt' => 11),
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


                $this->hki->insert([
                    'nidn_hki' => strip_tags($this->request->getPost('nidn_hki')),

                    'judul_hki' => strip_tags($this->request->getPost('judul_hki')),
                    'jenis_hki' => strip_tags($this->request->getPost('jenis_hki')),
                    'no_pendaftaran' => strip_tags($this->request->getPost('no_pendaftaran')),
                    'status_hki' => strip_tags($this->request->getPost('status_hki')),
                    'no_hki' => strip_tags($this->request->getPost('no_hki')),
                    'kd_sts_berkas_hki' => strip_tags($this->request->getPost('kd_sts_berkas_hki')),
                    'tahun_hki' => strip_tags($this->request->getPost('tahun_hki')),
                    'keterangan_invalid' => strip_tags($this->request->getPost('keterangan_invalid'))


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


    public function get_hki_edit()
    {
        if ($this->request->isAJAX()) {
            $id_hki = $this->request->getVar('id_hki');

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
                    'tahun_hki' => $row['tahun_hki'],
                    'keterangan_invalid' => $row['keterangan_invalid']
                ];
            }

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

                    ]
                ];
            } else {


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
                    'tahun_hki' => strip_tags($this->request->getPost('tahun_hki')),
                    'keterangan_invalid' => strip_tags($this->request->getPost('keterangan_invalid'))


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
