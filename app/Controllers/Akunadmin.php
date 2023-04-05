<?php

namespace App\Controllers;


use App\Models\Akunadmin_model;


class Akunadmin extends BaseController
{


    public function __construct()
    {
        require_once APPPATH . 'ThirdParty/ssp.class.php';
        $this->db = db_connect();
        $this->akunadmin = new Akunadmin_model();
        helper('form');
    }

    public function index()
    {

        if (session()->get('role') == "1" && session()->get('username') == "admin") {
            return view('pages/admin/a_akunadmin/index');
        } elseif (session()->get('role') == "1" && session()->get('username') != "admin") {
            return redirect()->to(base_url('admin'));
        } elseif (session()->get('role') == "2") {
            return redirect()->to(base_url('user'));
        } else {
            exit('404 Not Found');
        }
    }

    public function get_akunadmin()
    {
        if ($this->request->isAJAX()) {

            $result = [
                'output' => view('pages/admin/a_akunadmin/list_akunadmin')
            ];

            echo json_encode($result);
        }
    }

    public function getAllakunadmin()
    {

        $table = 'admin';

        // Table's primary key
        $primaryKey = 'id_admin';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes
        $columns = array(
            array('db' => 'nama_admin', 'dt' => 1),
            array('db' => 'username',  'dt' => 2),
            array('db' => 'id_admin',     'dt' => 3)
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

    public function get_add_akunadmin()
    {
        if ($this->request->isAJAX()) {
            $result = [
                'output' => view('pages/modals/akunadmin/add_akunadmin')
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
                'nama_admin' => [
                    'label' => 'nama_admin',
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required' => 'Kolom Nama Admin tidak boleh kosong',
                        'min_length' => 'Minimal 3 huruf',
                    ],
                ],
                'username' => [
                    'label' => 'username',
                    'rules' => 'required|is_unique[admin.username]|min_length[3]',
                    'errors' => [
                        'required' => 'Kolom Username tidak boleh kosong',
                        'min_length' => 'Minimal 3 huruf',
                    ],
                ],
                'password' => [
                    'label' => 'password akun admin',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kolom Password tidak boleh kosong'
                    ],
                ],
                'password_confirm' => [
                    'label' => 'konfirmasi password akun admin',
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'required' => 'Kolom Konfirmasi Password Tidak Boleh Kosong',
                        'matches' => 'Password Tidak Sama',
                    ],
                ]
            ]);

            if (!$rules) {
                $result = [
                    'error' => [
                        'nama_admin' => $validation->getError('nama_admin'),
                        'username' => $validation->getError('username'),
                        'password' => $validation->getError('password'),
                        'password_confirm' => $validation->getError('password_confirm')
                    ]
                ];
            } else {


                $this->akunadmin->insert([
                    'nama_admin' => strip_tags($this->request->getPost('nama_admin')),
                    'username' => strip_tags($this->request->getPost('username')),
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







    public function get_akunadmin_edit()
    {
        if ($this->request->isAJAX()) {
            $id_admin = $this->request->getVar('id_admin');

            $row = $this->akunadmin->find($id_admin);

            $data = [
                'id_admin' => $row['id_admin'],
                'nama_admin' => $row['nama_admin'],
                'username' => $row['username'],

            ];

            $result = [
                'output' => view('pages/modals/akunadmin/edit_akunadmin', $data)
            ];

            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }



    public function update_data($oldid_admin)
    {
        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();





            $rules = $this->validate([
                'nama_admin' => [
                    'label' => 'nama_admin',
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required' => 'Kolom Nama Admin tidak boleh kosong',
                        'min_length' => 'Minimal 3 huruf',
                    ],
                ],
                'username' => [
                    'label' => 'username',
                    'rules' => 'required|is_unique[admin.username,id_admin,' . $oldid_admin . ']|min_length[3]',
                    'errors' => [
                        'required' => 'Kolom Username tidak boleh kosong',
                        'is_unique' => 'Username Sudah Digunakan',
                        'min_length' => 'Minimal 3 huruf',
                    ],
                ],
                // 'password' => [
                //     'label' => 'password akun admin',
                //     'rules' => 'required',
                //     'errors' => [
                //         'required' => 'Kolom Password tidak boleh kosong'
                //     ],
                // ],
                'password_confirm' => [
                    'label' => 'konfirmasi password akun admin',
                    'rules' => 'matches[password]',
                    'errors' => [

                        'matches' => 'Password Tidak Sama',
                    ],
                ]
            ]);

            if (!$rules) {
                $result = [
                    'error' => [
                        'nama_admin' => $validation->getError('nama_admin'),
                        'username' => $validation->getError('username'),
                        // 'password' => $validation->getError('password'),
                        'password_confirm' => $validation->getError('password_confirm')
                    ]
                ];
            } else {
                $id_admin = $this->request->getPost('id_admin');
                if ($this->request->getPost('password') != null) {
                    $this->akunadmin->update($id_admin, [
                        'nama_admin' => strip_tags($this->request->getPost('nama_admin')),
                        'username' => strip_tags($this->request->getPost('username')),
                        'password' => strip_tags(password_hash($this->request->getPost('password'), PASSWORD_DEFAULT))
                    ]);
                } else {
                    $this->akunadmin->update($id_admin, [
                        'nama_admin' => strip_tags($this->request->getPost('nama_admin')),
                        'username' => strip_tags($this->request->getPost('username')),
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



    public function delete_data()
    {
        if ($this->request->isAJAX()) {
            $id_admin = $this->request->getVar('id_admin');

            $this->akunadmin->delete($id_admin);

            $result = [
                'output' => "Data admin berhasil dihapus"
            ];

            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }
}
