<?php

namespace App\Controllers;

use App\Models\Anggota_model;
use App\Models\Dosen_model;


class Dosen extends BaseController
{
    // protected $dosen;

    public function __construct()
    {
        require_once APPPATH . 'ThirdParty/ssp.class.php';
        $this->db = db_connect();
        $this->dosen = new Dosen_model();
        $this->anggotapenelitian = new Anggota_model();
        helper('form');
    }

    public function index()
    {


        if (session()->get('role') == "1") {
            return view('pages/admin/a_dosen/index');
        } elseif (session()->get('role') == "2") {
            return view('pages/user/u_dosen/index');
        } else {
            exit('404 Not Found');
        }                // return view('pages/admin/a_dosen/index');
    }

    public function get_dosen()
    {
        if ($this->request->isAJAX()) {
            if (session()->get('role') == "1") {
                $result = [
                    'output' => view('pages/admin/a_dosen/list_dosen')
                ];

                echo json_encode($result);
            } elseif (session()->get('role') == "2") {


                $page = (isset($_POST['page'])) ? $_POST['page'] : 1;

                $limit = 10;
                $limit_start = ($page - 1) * $limit;
                $no = $limit_start + 1;

                $s_jekel = "";
                $s_search = "";



                if (isset($_POST['jekel'])) {
                    $s_jekel = $_POST['jekel'];
                    $s_search = $_POST['search'];
                }


                $query = $this->db->query("SELECT *
                FROM dosen
                WHERE 
                jekel LIKE '%$s_jekel%' AND
                (nidn LIKE '%$s_search%' OR
                nama_dosen LIKE '%$s_search%' OR
                gelar LIKE '%$s_search%' OR
                nip LIKE '%$s_search%' OR
                jabatan_akademik LIKE '%$s_search%' OR
                program_studi LIKE '%$s_search%')
                ORDER BY nama_dosen ASC LIMIT $limit_start, $limit");

                $jmlData =  $this->db->query("SELECT count(*) as jumlah
                FROM dosen
                WHERE 
                jekel LIKE '%$s_jekel%' AND
                (nidn LIKE '%$s_search%' OR
                nama_dosen LIKE '%$s_search%' OR
                gelar LIKE '%$s_search%' OR
                nip LIKE '%$s_search%' OR
                jabatan_akademik LIKE '%$s_search%' OR
                program_studi LIKE '%$s_search%')");

                $data = [
                    'data_dosen' => $query,
                    'total' => $jmlData,


                ];
                return view('pages/user/u_dosen/list_dosen', $data);
            }
        } else {
            exit('404 Not Found');
        }
    }

    public function getAlldosen()
    {

        $table = 'dosen';

        // Table's primary key
        $primaryKey = 'nidn';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array('db' => 'nidn', 'dt' => 1),
            array('db' => 'nama_dosen',  'dt' => 2),
            array('db' => 'gelar',   'dt' => 3),
            array('db' => 'nip',     'dt' => 4),
            array('db' => 'jekel',     'dt' => 5),
            array('db' => 'jabatan_akademik',     'dt' => 6),
            array('db' => 'program_studi',     'dt' => 7),
            array('db' => 'nidn',     'dt' => 8)
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

    public function get_add_dosen()
    {
        if ($this->request->isAJAX()) {
            $result = [
                'output' => view('pages/modals/dosen/add_dosen')
            ];

            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }

    public function save_data()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();




            $rules = $this->validate([
                'nidn' => [
                    'label' => 'nidn dosen',
                    'rules' => 'required|is_unique[dosen.nidn]|min_length[3]',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided',
                        'min_length' => 'Minimal 3 huruf',
                    ],
                ],
                'nama_dosen' => [
                    'label' => 'nama dosen',
                    'rules' => 'required|min_length[3]',
                ],
                'jekel' => [
                    'label' => 'jekel dosen',
                    'rules' => 'required',
                ],
                'program_studi' => [
                    'label' => 'program studi dosen',
                    'rules' => 'required',
                ],
                'password' => [
                    'label' => 'password dosen',
                    'rules' => 'required',
                ],
                'password_confirm' => [
                    'label' => 'konfirmasi password dosen',
                    'rules' => 'required|matches[password]',
                ]
            ]);

            if (!$rules) {
                $result = [
                    'error' => [
                        'nidn' => $validation->getError('nidn'),
                        'nama_dosen' => $validation->getError('nama_dosen'),
                        'jekel' => $validation->getError('jekel'),
                        'program_studi' => $validation->getError('program_studi'),
                        'password' => $validation->getError('password'),
                        'password_confirm' => $validation->getError('password_confirm')
                    ]
                ];
            } else {


                $this->dosen->insert([
                    'nidn' => strip_tags($this->request->getPost('nidn')),
                    'nama_dosen' => strip_tags($this->request->getPost('nama_dosen')),
                    'gelar' => strip_tags($this->request->getPost('gelar')),
                    'nip' => strip_tags($this->request->getPost('nip')),
                    'jekel' => strip_tags($this->request->getPost('jekel')),
                    'jabatan_akademik' => strip_tags($this->request->getPost('jabatan_akademik')),
                    'program_studi' => strip_tags($this->request->getPost('program_studi')),
                    'password' => strip_tags(password_hash($this->request->getPost('password'), PASSWORD_DEFAULT))
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



    public function detail_dosen($nidn)
    {
        $query = $this->db->query("SELECT *
            FROM dosen
            WHERE nidn='$nidn'");
        $data = [
            'detail' => $query,
            'nidn' => $nidn,


        ];


        return view('pages/user/u_dosen/detail_dosen', $data);
    }


    public function get_penelitian_detail($nidn)
    {
        if ($this->request->isAJAX()) {

            $data = [
                'nidn' => $nidn

            ];
            $result = [
                'output' => view('pages/user/u_dosen/detail_penelitian/list_penelitian', $data)
            ];

            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }

    public function get_pemakalah_detail($nidn)
    {
        if ($this->request->isAJAX()) {

            $data = [
                'nidn' => $nidn

            ];
            $result = [
                'output' => view('pages/user/u_dosen/detail_pemakalah/list_pemakalah', $data)
            ];

            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }


    public function get_jurnal_detail($nama)
    {
        if ($this->request->isAJAX()) {
            $data = [
                'nama' => $nama

            ];
            $result = [
                'output' => view('pages/user/u_dosen/detail_jurnal/list_jurnal', $data)
            ];

            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }


    public function get_hki_detail($nidn)
    {
        if ($this->request->isAJAX()) {
            $data = [
                'nidn' => $nidn

            ];
            $result = [
                'output' => view('pages/user/u_dosen/detail_hki/list_hki', $data)
            ];

            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }

    public function get_buku_ajar_detail($nidn)
    {
        if ($this->request->isAJAX()) {
            $data = [
                'nidn' => $nidn

            ];
            $result = [
                'output' => view('pages/user/u_dosen/detail_buku_ajar/list_buku_ajar', $data)
            ];

            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }

    //-------------------------------------//

    public function getAllpenelitiandetail($nidn)
    {


        $table = <<<EOT
        (
            SELECT penelitian.*, dosen.*, agt.*
            FROM penelitian 
            JOIN dosen ON penelitian.nidn_ketua = dosen.nidn
            LEFT JOIN (SELECT anggota_penelitian.id_pen, GROUP_CONCAT(dosen.nama_dosen SEPARATOR ', ') as nama_agt 
            FROM anggota_penelitian
            JOIN dosen ON anggota_penelitian.nidn = dosen.nidn
            GROUP BY anggota_penelitian.id_pen) agt ON penelitian.id_penelitian = agt.id_pen
            WHERE nidn_ketua='$nidn' OR nidn='$nidn'
        ) temp
EOT;

        // Table's primary key
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

    public function getAllpemakalahdetail($nidn)
    {


        $table = <<<EOT
        (
            SELECT pemakalah.*, dosen.*
            FROM pemakalah
            JOIN dosen ON pemakalah.nidn_pem = dosen.nidn
            WHERE nidn='$nidn'
        ) temp
EOT;

        // Table's primary key
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

    public function getAlljurnaldetail($nama)
    {


        $table = <<<EOT
        (
            SELECT *
            FROM jurnal
            WHERE nama_personil LIKE '%$nama%'
        ) temp
EOT;

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

    public function getAllhkidetail($nidn)
    {


        $table = <<<EOT
            (
                SELECT hki.*, dosen.*
                FROM hki
                JOIN dosen ON hki.nidn_hki = dosen.nidn
                WHERE nidn_hki='$nidn'
            ) temp
    EOT;

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

    public function getAllbukuajardetail($nidn)
    {


        $table = <<<EOT
            (
                SELECT buku_ajar.*, dosen.*
                FROM buku_ajar
                JOIN dosen ON buku_ajar.nidn_buku_ajar = dosen.nidn
                WHERE nidn_buku_ajar='$nidn'
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
            array('db' => 'keterangan_invalid', 'dt' => 7),
            array('db' => 'id_buku_ajar', 'dt' => 8),
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


    public function get_dosen_edit()
    {
        if ($this->request->isAJAX()) {
            $nidn = $this->request->getVar('nidn');

            $row = $this->dosen->find($nidn);

            $data = [
                'nidn' => $row['nidn'],
                'nama_dosen' => $row['nama_dosen'],
                'gelar' => $row['gelar'],
                'nip' => $row['nip'],
                'jekel' => $row['jekel'],
                'jabatan_akademik' => $row['jabatan_akademik'],
                'program_studi' => $row['program_studi'],
                // 'password' => $row['password'],
                // 'password_confirm' => $row['password']
            ];

            $result = [
                'output' => view('pages/modals/dosen/edit_dosen', $data)
            ];

            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }

    public function get_ubah_password()
    {
        if ($this->request->isAJAX()) {
            $nidn = $this->request->getVar('nidn');

            $row = $this->dosen->find($nidn);

            $data = [
                'nidn' => $row['nidn'],
            ];

            $result = [
                'output' => view('pages/modals/dosen/ubah_pass', $data)
            ];

            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }

    public function update_data($oldnidn)
    {
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();


            $rules = $this->validate([
                'nidn' => [
                    'label' => 'nidn dosen',
                    'rules' => 'required|is_unique[dosen.nidn,nidn,' . $oldnidn . ']|min_length[3]',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided',
                        'min_length' => 'Minimal 3 huruf',
                        'is_unique' => 'NIDN sudah digunakan',
                    ],
                ],
                'nama_dosen' => [
                    'label' => 'nama dosen',
                    'rules' => 'required|min_length[3]',
                ],
                'jekel' => [
                    'label' => 'jekel dosen',
                    'rules' => 'required',
                ],
                'program_studi' => [
                    'label' => 'program studi dosen',
                    'rules' => 'required',
                ],

                'password_confirm' => [
                    'label' => 'konfirmasi password dosen',
                    'rules' => 'matches[password]',
                ]
            ]);


            if (!$rules) {
                $result = [
                    'error' => [
                        'nidn' => $validation->getError('nidn'),
                        'nama_dosen' => $validation->getError('nama_dosen'),
                        'jekel' => $validation->getError('jekel'),
                        'program_studi' => $validation->getError('program_studi'),
                        // 'password' => $validation->getError('password'),
                        'password_confirm' => $validation->getError('password_confirm')
                    ]
                ];
            } else {
                $nidn = $this->request->getPost('nidn');
                if ($this->request->getPost('password') != null) {
                    $this->dosen->update($nidn, [
                        'nidn' => strip_tags($this->request->getPost('nidn')),
                        'nama_dosen' => strip_tags($this->request->getPost('nama_dosen')),
                        'gelar' => strip_tags($this->request->getPost('gelar')),
                        'nip' => strip_tags($this->request->getPost('nip')),
                        'jekel' => strip_tags($this->request->getPost('jekel')),
                        'jabatan_akademik' => strip_tags($this->request->getPost('jabatan_akademik')),
                        'program_studi' => strip_tags($this->request->getPost('program_studi')),
                        'password' => strip_tags(password_hash($this->request->getPost('password'), PASSWORD_DEFAULT))
                    ]);
                } else {
                    $this->dosen->update($nidn, [
                        'nidn' => strip_tags($this->request->getPost('nidn')),
                        'nama_dosen' => strip_tags($this->request->getPost('nama_dosen')),
                        'gelar' => strip_tags($this->request->getPost('gelar')),
                        'nip' => strip_tags($this->request->getPost('nip')),
                        'jekel' => strip_tags($this->request->getPost('jekel')),
                        'jabatan_akademik' => strip_tags($this->request->getPost('jabatan_akademik')),
                        'program_studi' => strip_tags($this->request->getPost('program_studi')),
                    ]);
                }


                $result = [
                    'success' => 'Data has been added to database'
                ];
            }
            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }

    public function update_data_pass()
    {
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();

            $rules = $this->validate([

                'password' => [
                    'label' => 'password dosen',
                    'rules' => 'required',
                ],
                'password_confirm' => [
                    'label' => 'konfirmasi password dosen',
                    'rules' => 'required|matches[password]',
                ]
            ]);


            if (!$rules) {
                $result = [
                    'error' => [
                        'password' => $validation->getError('password'),
                        'password_confirm' => $validation->getError('password_confirm')
                    ]
                ];
            } else {
                $nidn = $this->request->getPost('nidn');

                $this->dosen->update($nidn, [
                    'password' => strip_tags(password_hash($this->request->getPost('password'), PASSWORD_DEFAULT))
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
            $nidn = $this->request->getVar('nidn');

            $this->dosen->delete($nidn);

            $result = [
                'output' => "Data dosen berhasil dihapus"
            ];

            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }
}
