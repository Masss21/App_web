<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AdminModel;
use App\Models\AntrianModel;
use App\Models\PelangganModel;
use App\Models\KendaraanModel;
use App\Models\ServisModel;
use CodeIgniter\HTTP\ResponseInterface;

class Admin extends Controller
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        helper(['form', 'url']);
        session();
    }

    // Form Login
    public function login()
    {
        return view('admin/login');
    }

    // Proses Login (tanpa hash untuk sementara)
    public function loginProcess()
    {
        log_message('debug', 'Masuk loginProcess');
    log_message('debug', 'Tipe request: ' . $this->request->getMethod());
    log_message('debug', 'Is AJAX? ' . json_encode($this->request->isAJAX()));
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $admin = (new AdminModel())
                 ->where('email',$email)
                 ->where('password',$password)
                 ->first();

        if ($admin) {
            session()->set([
                'admin_logged_in' => true,
                'admin_email'     => $email
            ]);
            if ($this->request->isAJAX()) {
                return $this->response
                            ->setStatusCode(ResponseInterface::HTTP_OK)
                            ->setJSON(['success'=>'Login berhasil','error'=>null]);
            }
            return redirect()->to('/admin/dashboard');
        }

        // gagal
        if ($this->request->isAJAX()) {
            return $this->response
                        ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED)
                        ->setJSON(['success'=>null,'error'=>'Email atau password salah']);
        }
        return redirect()->back()->with('error','Email atau password salah');
    }

    // Dashboard
    public function dashboard()
    {
        if (!session()->get('admin_logged_in')) {
            return redirect()->to('/admin/login');
        }

        return view('admin/layout', ['page' => 'dashboard']);
    }

    // Logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    // AJAX loader untuk semua halaman admin
    public function ajaxLoad($page)
    {
        if (!session()->get('admin_logged_in')) {
            return 'Unauthorized';
        }

        $validPages = ['dashboard', 'antrian', 'pelanggan', 'kendaraan', 'servis', 'laporan', 'nota'];

        if (!in_array($page, $validPages)) {
            return 'Halaman tidak ditemukan';
        }
        
        if ($page === 'dashboard') {
    $pelangganModel = new \App\Models\PelangganModel();
    $kendaraanModel = new \App\Models\KendaraanModel();
    $antrianModel   = new \App\Models\AntrianModel();

    $data = [
        'total_customer'  => $pelangganModel->countAll(),
        'total_kendaraan' => $kendaraanModel->countAll(),
        'total_antrian'   => $antrianModel->countAll(),
        'total_pending'   => $antrianModel->where('status', 'pending')->countAllResults(),
    ];

    return view('admin/dashboard', $data);
}

        if ($page === 'antrian') {
            $antrianModel = new AntrianModel();
            $data['antrian'] = $antrianModel->orderBy('tanggal', 'desc')->findAll();
            return view('admin/antrian', $data);
        }

        if ($page === 'pelanggan') {
            $pelangganModel = new PelangganModel();
            $data['pelanggan'] = $pelangganModel->findAll();
            return view('admin/pelanggan', $data);
        }

        if ($page === 'kendaraan') {
    $kendaraanModel = new KendaraanModel();
    $data['kendaraan'] = $kendaraanModel
        ->select('kendaraan.*, pelanggan.nama as nama_pelanggan')
        ->join('pelanggan', 'pelanggan.id = kendaraan.id_pelanggan')
        ->orderBy('kendaraan.id', 'desc')
        ->findAll();
    return view('admin/kendaraan', $data);
}
       
       if ($page === 'servis') {
    $servisModel = new ServisModel();
    $data['servis'] = $servisModel
        ->select('servis.*, kendaraan.no_polisi, kendaraan.merk')
        ->join('kendaraan', 'kendaraan.id = servis.id_kendaraan')
        ->orderBy('tanggal_servis', 'desc')
        ->findAll();
    return view('admin/servis', $data);
}
     
     if ($page === 'nota') {
    $servisModel = new ServisModel();
    $data['servis'] = $servisModel
        ->select('servis.*, kendaraan.no_polisi, pelanggan.nama as nama_pelanggan')
        ->join('kendaraan', 'kendaraan.id = servis.id_kendaraan')
        ->join('pelanggan', 'pelanggan.id = kendaraan.id_pelanggan')
        ->orderBy('tanggal_servis', 'desc')
        ->findAll();
    return view('admin/nota', $data);
} 
    if ($page === 'laporan') {
    return view('admin/laporan'); // tanpa data saat awal
}



        // Halaman lain yang belum perlu data
        return view('admin/' . $page);
    }

    // Form tambah/edit pelanggan (via AJAX)
    public function formPelanggan($id = null)
    {
        $model = new PelangganModel();
        $data = [];

        if ($id) {
            $data['pelanggan'] = $model->find($id);
        }

        return view('admin/form_pelanggan', $data);
    }

    // Simpan data pelanggan (AJAX)
    public function savePelanggan()
    {
        $model = new PelangganModel();

        $id = $this->request->getPost('id');
        $data = [
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'telepon' => $this->request->getPost('telepon'),
        ];

        if ($id) {
            $model->update($id, $data);
        } else {
            $model->insert($data);
        }

        return 'success';
    }

    // Hapus data pelanggan (AJAX)
    public function deletePelanggan()
{
    $id = $this->request->getPost('id');
    $model = new PelangganModel();
    $model->delete($id);
    return 'deleted';
}


    public function formKendaraan($id = null)
{
    $kendaraanModel = new KendaraanModel();
    $pelangganModel = new PelangganModel();

    $data['pelanggan'] = $pelangganModel->findAll();

    if ($id) {
        $data['kendaraan'] = $kendaraanModel->find($id);
    }

    return view('admin/form_kendaraan', $data);
}

public function saveKendaraan()
{
    $model = new KendaraanModel();

    $id = $this->request->getPost('id');
    $data = [
        'no_polisi'    => $this->request->getPost('no_polisi'),
        'merk'         => $this->request->getPost('merk'),
        'tipe'         => $this->request->getPost('tipe'),
        'tahun'        => $this->request->getPost('tahun'),
        'id_pelanggan' => $this->request->getPost('id_pelanggan'),
    ];

    if ($id) {
        $model->update($id, $data);
    } else {
        $model->insert($data);
    }

    return 'success';
}

public function deleteKendaraan($id)
{
    $model = new KendaraanModel();
    $model->delete($id);
    return 'deleted';
}

public function formServis($id = null)
{
    $servisModel = new ServisModel();
    $kendaraanModel = new KendaraanModel();

    $data['kendaraan'] = $kendaraanModel->findAll();

    if ($id) {
        $data['servis'] = $servisModel->find($id);
    }

    return view('admin/form_servis', $data);
}

public function saveServis()
{
    $model = new ServisModel();

    $id = $this->request->getPost('id');
    $data = [
        'id_kendaraan'   => $this->request->getPost('id_kendaraan'),
        'tanggal_servis' => $this->request->getPost('tanggal_servis'),
        'jenis_servis'   => $this->request->getPost('jenis_servis'),
        'biaya'          => $this->request->getPost('biaya'),
    ];

    if ($id) {
        $model->update($id, $data);
    } else {
        $model->insert($data);
    }

    return 'success';
}

public function deleteServis($id)
{
    $model = new ServisModel();
    $model->delete($id);
    return 'deleted';
}

public function cetakNota($id)
{
    $model = new ServisModel();

    $data['servis'] = $model
        ->select('servis.*, kendaraan.no_polisi, kendaraan.merk, pelanggan.nama as nama_pelanggan')
        ->join('kendaraan', 'kendaraan.id = servis.id_kendaraan')
        ->join('pelanggan', 'pelanggan.id = kendaraan.id_pelanggan')
        ->where('servis.id', $id)
        ->first();

    return view('admin/cetak_nota', $data);
}

public function cetakLaporan()
{
    $start     = $this->request->getGet('start');
    $end       = $this->request->getGet('end');
    $pelanggan = $this->request->getGet('pelanggan');
    $kendaraan = $this->request->getGet('kendaraan');

    $servisModel = new ServisModel();
    $query = $servisModel
        ->select('servis.*, kendaraan.no_polisi, pelanggan.nama as nama_pelanggan')
        ->join('kendaraan', 'kendaraan.id = servis.id_kendaraan')
        ->join('pelanggan', 'pelanggan.id = kendaraan.id_pelanggan');

    if ($start && $end) {
        $query->where("tanggal_servis BETWEEN '$start' AND '$end'");
    }
    if ($pelanggan) {
        $query->where('pelanggan.nama', $pelanggan);
    }
    if ($kendaraan) {
        $query->where('kendaraan.no_polisi', $kendaraan);
    }

    $data['servis'] = $query->orderBy('tanggal_servis', 'DESC')->findAll();
    $data['start'] = $start;
    $data['end'] = $end;

    return view('admin/cetak_laporan', $data);
}
  
public function getAntrian($id)
{
    $model = new \App\Models\AntrianModel();
    $antrian = $model->find($id);
    
    if ($antrian) {
        return json_encode($antrian);
    }

    return $this->response->setJSON($antrian);
}



public function updateStatusAntrian()
{
    $id = $this->request->getPost('id');

    $antrianModel = new \App\Models\AntrianModel();
    $pelangganModel = new \App\Models\PelangganModel();

    $antrian = $antrianModel->find($id);

    if (!$antrian) {
        return $this->response->setStatusCode(404)->setJSON(['error' => 'Antrian tidak ditemukan']);
    }

    // ✅ Update status antrian
    $antrianModel->update($id, ['status' => 'success, silahkan tunggu di ruang tunggu']);

    // ✅ Tambahkan ke pelanggan jika belum ada
    $existing = $pelangganModel
        ->where('nama', $antrian['nama'])
        ->where('telepon', $antrian['telepon'])
        ->first();

    if (!$existing) {
        $pelangganModel->insert([
            'nama' => $antrian['nama'],
            'telepon' => $antrian['telepon']
        ]);
    }

    return $this->response->setJSON(['status' => 'success']);
}



public function prosesAntrian($id)
{
    $antrianModel = new \App\Models\AntrianModel();
    $pelangganModel = new \App\Models\PelangganModel();

    $antrian = $antrianModel->find($id);

    if (!$antrian) {
        return $this->response->setStatusCode(404)->setBody('Antrian tidak ditemukan.');
    }

    // Update status antrian
    $antrianModel->update($id, ['status' => 'success, silahkan tunggu di ruang tunggu']);

    // Cek apakah pelanggan sudah ada
    $cek = $pelangganModel
        ->where('nama', $antrian['nama'])
        ->where('telepon', $antrian['telepon'])
        ->first();

    if (!$cek) {
        $pelangganModel->insert([
            'nama' => $antrian['nama'],
            'telepon' => $antrian['telepon']
        ]);
    }

    // Setelah diproses, kembali ke halaman pelanggan
    return redirect()->to('/admin/ajax/pelanggan');
}
   
public function cariLaporan()
{
    $start = $this->request->getGet('start');
    $end   = $this->request->getGet('end');

    $model = new \App\Models\ServisModel();
    $data['servis'] = $model
        ->select('servis.*, pelanggan.nama as nama_pelanggan, kendaraan.no_polisi')
        ->join('kendaraan', 'kendaraan.id = servis.id_kendaraan')
        ->join('pelanggan', 'pelanggan.id = kendaraan.id_pelanggan')
        ->where('tanggal_servis >=', $start)
        ->where('tanggal_servis <=', $end)
        ->orderBy('tanggal_servis', 'desc')
        ->findAll();

    return view('admin/partials/hasil_laporan', $data);
}

  public function deleteAntrian()
{
    $id = $this->request->getPost('id');
    $model = new \App\Models\AntrianModel();

    if ($model->delete($id)) {
        return $this->response->setJSON(['status' => 'ok']);
    }

    return $this->response->setStatusCode(500)->setJSON(['status' => 'error']);
}

public function getKategoriServis()
{
    $db = \Config\Database::connect();
    $data = $db->table('kategori_servis')->get()->getResultArray();
    return $this->response->setJSON($data);
}

}
