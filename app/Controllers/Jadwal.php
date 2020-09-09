<?php 
namespace App\Controllers;
use \Firebase\JWT\JWT;
use App\Models\Jadwal_model;
use App\Models\Mahasiswa_model;
use CodeIgniter\RESTful\ResourceController;

class Jadwal extends ResourceController
{
    public function __construct()
    {
        $this->jadwal = new Jadwal_model();
        $this->mahasiswa = new Mahasiswa_model();
    }

    public function index()
    {
        $jadwal  = $this->request->getPost('kode_jadwal') ? $this->request->getPost('kode_jadwal') : "";
        $nip  = $this->request->getPost('nip_dosen') ? $this->request->getPost('nip_dosen') : "";
        $dataJadwal = $this->jadwal->getJadwalAllBy(['nip_dosen'=>$nip]);
        $viewData = [];
        foreach ($dataJadwal as $key) {
            array_push($viewData,array(
                'kode_jadwal' => $key->kode_jadwal,
                'kode_matkul' => $key->kode_matkul,
                'nama_matkul' => $this->jadwal->getMatkul($key->kode_matkul)->nama_matkul,
                'nip_dosen' => $key->nip_dosen,
                'kelas_jadwal' => $key->kelas_jadwal,
                'hari' => $key->hari,
                'pukul' => $key->pukul,
                'ruang' => $key->ruang,
                'program_studi' => $key->program_studi,
                'semester' => $key->semester,
                'tahun_ajaran' => $key->tahun_ajaran,
            ));
        }
        
        return $this->respond(["result" => $viewData],200); 
    }

    public function getDetail()
    {
        $jumlah = 0;
        $kode_jadwal  = $this->request->getPost('kode_jadwal');
        $detailJadwal = $this->jadwal->getJadwal($kode_jadwal);
        $kelas_jadwal = explode("+",$detailJadwal["kelas_jadwal"]);
        
        
        for($i=0;$i < count($kelas_jadwal);$i++){
            $jumlah += count($this->mahasiswa->getMhsAllBy(["kelas"=> $kelas_jadwal[$i]]));
        }

        return $this->respond([
            'jumlahMhs' => $jumlah,
            'jadwal_detail' => $detailJadwal,
            'sesi_detail' => $this->jadwal->getSesiBy(['kode_jadwal' => $kode_jadwal])
        ],200);

        
    }
 
    public function test()
    {
        $jumlah = 0;
        $kelas_jadwal = explode("+",$this->jadwal->getJadwal("9")["kelas_jadwal"]);
        
        
        for($i=0;$i < count($kelas_jadwal);$i++){
            $jumlah += count($this->mahasiswa->getMhsAllBy(["kelas"=> $kelas_jadwal[$i]]));
        }
        echo $jumlah;
    }


}