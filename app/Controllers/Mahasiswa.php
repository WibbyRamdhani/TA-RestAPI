<?php namespace App\Controllers;
 
use \Firebase\JWT\JWT;
use App\Models\Mahasiswa_model;
use CodeIgniter\RESTful\ResourceController;
 
class Mahasiswa extends ResourceController
{
    public function __construct()
    {
        $this->mahasiswa = new Mahasiswa_model();
    }

    public function index(){
        $nrp  = $this->request->getPost('nrp') ? $this->request->getPost('nrp') : "";
        return $this->respond($this->mahasiswa->getMahasiswa($nrp));
    }

    public function add(){
        $nrp  = $this->request->getPost('nrp');
        $kelas  = $this->request->getPost('kelas');
        $semester   = $this->request->getPost('semester');
        $nama   = $this->request->getPost('nama');
        $tipe_kuliah   = $this->request->getPost('tipe_kuliah');

        $dataMahasiswa = [
            'nrp' => $nrp,
            'kelas' => $kelas,
            'semester' => $semester,
            'nama' => $nama,
            'tipe_kuliah' => $tipe_kuliah
        ];
 
        $mhs = $this->mahasiswa->addMahasiswa($dataMahasiswa);
 
        if($mhs == true){
            $output = [
                'status' => 200,
                'message' => 'Berhasil input data'
            ];
            return $this->respond($output, 200);
        } else {
            $output = [
                'status' => 400,
                'message' => 'Gagal input data'
            ];
            return $this->respond($output, 400);
        }
    }

     public function editMhs(){
        $nrp  = $this->request->getPost('nrp');
        $kelas  = $this->request->getPost('kelas');
        $semester   = $this->request->getPost('semester');
        $nama   = $this->request->getPost('nama');
        $tipe_kuliah   = $this->request->getPost('tipe_kuliah');

        $dataMahasiswa = [
            'nrp' => $nrp,
            'kelas' => $kelas,
            'semester' => $semester,
            'nama' => $nama,
            'tipe_kuliah' => $tipe_kuliah
        ];
 
        $editmhs = $this->mahasiswa->updateMahasiswa($dataMahasiswa, $nrp);
 
        if($editmhs == true){
            $output = [
                'status' => 200,
                'message' => 'Berhasil edit data'
            ];
            return $this->respond($output, 200);
        } else {
            $output = [
                'status' => 400,
                'message' => 'Gagal edit data'
            ];
            return $this->respond($output, 400);
        }
    }

    public function deleteMhs(){
        $nrp  = $this->request->getPost('nrp');
 
        $deletemhs = $this->mahasiswa->deleteMahasiswa($nrp);
 
        if($deletemhs == true){
            $output = [
                'status' => 200,
                'message' => 'Data berhasil di hapus'
            ];
            return $this->respond($output, 200);
        } else {
            $output = [
                'status' => 400,
                'message' => 'Data Gagal di hapus'
            ];
            return $this->respond($output, 400);
        }
    }

    
    
}


    