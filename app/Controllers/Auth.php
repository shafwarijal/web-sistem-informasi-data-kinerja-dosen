<?php

namespace App\Controllers;

use App\Models\Admin_model, App\Models\Dosen_model;

class Auth extends BaseController
{

    public function __construct()
    {
        $this->admindata = new Admin_model();
        $this->userdata = new Dosen_model();
    }

    public function index()
    {
        // If session == true, go to home page
        if (session()->get('data')) {
            if (session()->get('data')['role'] == 1) {
                // redirect to Admin
                return redirect()->to('/admin');
            } elseif (session()->get('data')['role'] == 2) {
                // Redirect to Member
                return redirect()->to('/user');
            }
        }

        $data = [
            'title' => 'Login',
            'validation' => \Config\Services::validation()
        ];
        return view('pages/login');
    }

    public function login()
    {
        // $admindata = new Admin_model();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $admin = $this->admindata->where(['username' => $username,])->first();
        $user = $this->userdata->where(['nidn' => $username])->first();

        if ($admin) {
            if (password_verify($password, $admin['password'])) {
                $data = [
                    'id' => $admin['id_admin'],
                    'nama_admin' => $admin['nama_admin'],
                    'username' => $admin['username'],
                    'role' => 1,
                ];
                session()->set($data);
                return redirect()->to(base_url('admin'));
            } else {
                session()->setFlashdata('error', 'Password Salah');
                return redirect()->to('');
            }
        } else if ($user) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'nidn' => $user['nidn'],
                    'nama_user' => $user['nama_dosen'],
                    'role' => 2,
                ];
                session()->set($data);
                return redirect()->to(base_url('user'));
            } else {
                session()->setFlashdata('error', 'Password Salah');
                return redirect()->to('');
            }
        } else {
            session()->setFlashdata('error', 'Username & Password Salah');
            return redirect()->to('');
        }
    }

    public function logout()
    {
        // Clear Session
        session()->destroy();
        // Redirect Login
        session()->setFlashData('message', 'You have been logout !');
        return redirect()->to('');
    }
}
