<?php

namespace App\Controllers;


use App\Models\Dosen_model;
use App\Models\Buku_Ajar_model;

class Buku_Ajar extends BaseController
{

    public function __construct()
    {
        require_once APPPATH . 'ThirdParty/ssp.class.php';
        $this->db = db_connect();
        $this->dosen = new Dosen_model();
        $this->bukuajar = new Buku_Ajar_model();

        helper('form');
    }

    public function index()
    {
        if (session()->get('role') == "1") {
            return view('pages/admin/a_buku_ajar/index');
        } elseif (session()->get('role') == "2") {
            return view('pages/user/u_buku_ajar/index');
        } else {
            exit('404 Not Found');
        }
    }

    public function get_buku_ajar()
    {
        if ($this->request->isAJAX()) {
            if (session()->get('role') == "1") {
                $result = [
                    'output' => view('pages/admin/a_buku_ajar/list_buku_ajar')
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


                $s_search = "";



                if (isset($_POST['search'])) {
                    $s_search = $_POST['search'];
                }


                $query = $this->db->query("SELECT buku_ajar.*, dosen.*
                FROM buku_ajar
                JOIN dosen ON buku_ajar.nidn_buku_ajar = dosen.nidn
                WHERE 
                nama_dosen LIKE '%$s_search%' OR
                judul_buku_ajar LIKE '%$s_search%' OR
                isbn LIKE '%$s_search%' OR
                jumlah_halaman LIKE '%$s_search%' OR
                tahun_buku_ajar LIKE '%$s_search%' OR
                penerbit LIKE '%$s_search%'
                ORDER BY nama_dosen ASC LIMIT $limit_start, $limit");



                $jmlData =  $this->db->query("SELECT count(*) as jumlah
                FROM buku_ajar
                JOIN dosen ON buku_ajar.nidn_buku_ajar = dosen.nidn
                WHERE 
                nama_dosen LIKE '%$s_search%' OR
                judul_buku_ajar LIKE '%$s_search%' OR
                isbn LIKE '%$s_search%' OR
                jumlah_halaman LIKE '%$s_search%' OR
                tahun_buku_ajar LIKE '%$s_search%' OR
                penerbit LIKE '%$s_search%'");

                $data = [
                    'data_buku_ajar' => $query,
                    'total' => $jmlData,


                ];
                return view('pages/user/u_buku_ajar/list_buku_ajar', $data);
            }
            // $data = [
            //     'data_penelitian' => $this->penelitian->findAll()
            // ];


        } else {
            exit('404 Not Found');
        }
    }



    public function getAllbukuajar()
    {


        $table = <<<EOT
            (
                SELECT buku_ajar.*, dosen.*
                FROM buku_ajar
                JOIN dosen ON buku_ajar.nidn_buku_ajar = dosen.nidn
            ) temp
    EOT;
        // <<<EOT
        // (
        //     SELECT penelitian.*, dosen.*
        //     FROM penelitian
        //     JOIN dosen on penelitian.nidn_ketua = dosen.nidn
        // ) temp
        // EOT;

        // Table's primary key
        $primaryKey = 'id_buku_ajar';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array('db' => 'nidn_buku_ajar', 'dt' => 1),
            array('db' => 'nama_dosen', 'dt' => 2),
            array('db' => 'judul_buku_ajar', 'dt' => 3),
            array('db' => 'isbn', 'dt' => 4),
            array('db' => 'jumlah_halaman', 'dt' => 5),
            array('db' => 'penerbit', 'dt' => 6),
            array('db' => 'tahun_buku_ajar', 'dt' => 7),
            array('db' => 'keterangan_invalid', 'dt' => 8),
            array('db' => 'id_buku_ajar', 'dt' => 9),
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

    public function get_add_buku_ajar()
    {
        if ($this->request->isAJAX()) {
            $result = [
                'output' => view('pages/modals/buku_ajar/add_buku_ajar')
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
                'nidn_buku_ajar' => [
                    'label' => 'nidn_buku_ajar',
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided',
                        'min_length' => 'Minimal 3 huruf',
                    ],
                ],

                'judul_buku_ajar' => [
                    'label' => 'judul_buku_ajar',
                    'rules' => 'required|min_length[3]',
                ],

            ]);

            if (!$rules) {
                $result = [
                    'error' => [
                        'nidn_buku_ajar' => $validation->getError('nidn_buku_ajar'),
                        'judul_buku_ajar' => $validation->getError('judul_buku_ajar'),
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

                $this->bukuajar->insert([
                    'nidn_buku_ajar' => strip_tags($this->request->getPost('nidn_buku_ajar')),
                    // 'nama_dosen' => strip_tags($this->request->getPost('nama_dosen')),
                    'judul_buku_ajar' => strip_tags($this->request->getPost('judul_buku_ajar')),
                    'isbn' => strip_tags($this->request->getPost('isbn')),
                    'jumlah_halaman' => strip_tags($this->request->getPost('jumlah_halaman')),
                    'penerbit' => strip_tags($this->request->getPost('penerbit')),
                    'tahun_buku_ajar' => strip_tags($this->request->getPost('tahun_buku_ajar')),
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


    public function get_buku_ajar_edit()
    {
        if ($this->request->isAJAX()) {
            $id_buku_ajar = $this->request->getVar('id_buku_ajar');
            $builder = $this->db->table('buku_ajar');
            $builder->select('*');
            $builder->join('dosen', 'buku_ajar.nidn_buku_ajar = dosen.nidn');
            $builder->where('id_buku_ajar', $id_buku_ajar);
            $query = $builder->get();

            foreach ($query->getResultArray() as $row) {
                $data = [
                    'id_buku_ajar' => $row['id_buku_ajar'],
                    'nama_dosen' => $row['nama_dosen'],
                    'nidn_buku_ajar' => $row['nidn_buku_ajar'],
                    'judul_buku_ajar' => $row['judul_buku_ajar'],
                    'isbn' => $row['isbn'],
                    'jumlah_halaman' => $row['jumlah_halaman'],
                    'penerbit' => $row['penerbit'],
                    'tahun_buku_ajar' => $row['tahun_buku_ajar'],
                    'keterangan_invalid' => $row['keterangan_invalid']
                ];
            }

            $result = [
                'output' => view('pages/modals/buku_ajar/edit_buku_ajar', $data)
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
                'nidn_buku_ajar' => [
                    'label' => 'nidn_buku_ajar',
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided',
                        'min_length' => 'Minimal 3 huruf',
                    ],
                ],

                'judul_buku_ajar' => [
                    'label' => 'judul_buku_ajar',
                    'rules' => 'required|min_length[3]',
                ],

            ]);


            if (!$rules) {
                $result = [
                    'error' => [
                        'nidn_buku_ajar' => $validation->getError('nidn_buku_ajar'),
                        'judul_buku_ajar' => $validation->getError('judul_buku_ajar'),
                    ]
                ];
            } else {
                // if ($this->request->getPost('nidn') == null) {
                //     return view('pages/admin/u_dosen/index');
                // }

                $id_buku_ajar = $this->request->getPost('id_buku_ajar');

                $this->bukuajar->update($id_buku_ajar, [
                    'nidn_buku_ajar' => strip_tags($this->request->getPost('nidn_buku_ajar')),
                    // 'nama_dosen' => strip_tags($this->request->getPost('nama_dosen')),
                    'judul_buku_ajar' => strip_tags($this->request->getPost('judul_buku_ajar')),
                    'isbn' => strip_tags($this->request->getPost('isbn')),
                    'jumlah_halaman' => strip_tags($this->request->getPost('jumlah_halaman')),
                    'penerbit' => strip_tags($this->request->getPost('penerbit')),
                    'tahun_buku_ajar' => strip_tags($this->request->getPost('tahun_buku_ajar')),
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
            $id_buku_ajar = $this->request->getVar('id_buku_ajar');

            $this->bukuajar->delete($id_buku_ajar);

            $result = [
                'output' => "Data penelitian berhasil dihapus"
            ];

            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }
}
