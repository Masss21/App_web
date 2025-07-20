<?php

namespace App\Controllers;
use App\Models\AntrianModel;
use CodeIgniter\Controller;


class Pelanggan extends Controller
{
    public function home()
    {
        return view('pelanggan/home');
    }

    public function formAntrian()
    {
        return view('pelanggan/antrian');
    }

    public function loginProcess()
{
    $request = $this->request;

    // Untuk request AJAX
    if ($request->isAJAX()) {
        $username = $request->getPost('username');
        $password = $request->getPost('password');

        if ($username === 'admin' && $password === '123') {
            session()->set('admin_logged_in', true);
            return $this->response->setJSON(['success' => 'Login berhasil!']);
        } else {
            return $this->response->setJSON(['error' => 'Login gagal!']);
        }
    }

    // Untuk fallback (jika bukan AJAX)
    return redirect()->to('/')->with('error', 'Silahkan coba lagi.');
}

   public function submitAntrian()
{
    $nama = $this->request->getPost('nama');
    $telepon = $this->request->getPost('telepon');

    if (!$nama || !$telepon) {
        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['error' => 'Data tidak lengkap.']);
        }
        return redirect()->back()->with('error', 'Data tidak lengkap.');
    }

    $model = new \App\Models\AntrianModel();
    $model->insert(['nama' => $nama, 'telepon' => $telepon]);

    if ($this->request->isAJAX()) {
        return $this->response->setJSON(['success' => 'Antrian berhasil diambil.']);
    }

    return redirect()->back()->with('success', 'Antrian berhasil diambil.');
}


}
