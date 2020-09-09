<?php namespace App\Controllers;
 
use \Firebase\JWT\JWT;
use App\Models\Presensi_model;
use App\Models\Jadwal_model;
use App\Models\Mahasiswa_model;
use CodeIgniter\RESTful\ResourceController;
 
class Presensi extends ResourceController
{
    protected $helpers = ['url','file','my_helper'];
    public function __construct()
    {
        $this->presensi = new Presensi_model();
        $this->mahasiswa = new Mahasiswa_model();
        $this->jadwal = new Jadwal_model();
    }

    public function index(){
        $presensi  = $this->request->getPost('kode_presensi') ? $this->request->getPost('kode_presensi') : "";
        return $this->respond($this->presensi->getPresensi($presensi));
    }

    public function create()
    {
        $nrp = $this->request->getPost('nrp');
        $kode_jadwal = $this->request->getPost('kode_jadwal');
        $kode_sesi = $this->request->getPost('kode_sesi');
        $input_presensi = [
            'nrp' => $nrp,
            'kode_sesi' => $kode_sesi,
            'waktu'  => $this->request->getPost('waktu'),
            'status'  => $this->request->getPost('status'),
        ];

        $callback ="";
        
        if ($this->mahasiswa->cariMHS($nrp)) {
            $kelas = $this->mahasiswa->cariMHS($nrp)->kelas;
            
            $kelas_jadwal = explode("+",$this->jadwal->getJadwalAllBy(["kode_jadwal"=> $this->jadwal->getSesi(["kode_sesi" => $kode_sesi])->kode_jadwal])[0]->kelas_jadwal);
            
            if(in_array($kelas,$kelas_jadwal)){
                $callback = $this->presensi->add($input_presensi);
            }else{
                return $this->respond([
                    'http_code' => 401,
                    'status' => 'error',
                    "message" => "Mahasiswa tidak dapat mengikuti mata kuliah ini",
                    "data" => [$input_presensi]
                    ],401);
            }
        
        }else{
            return $this->respond([
                'http_code' => 401,
                'status' => 'error',
                "message" => "Mahasiswa tidak ditemukan",
                "data" => []
            ],401);
        }

        if ($callback) {
            return $this->respond([
                'http_code' => 200,
                'status' => 'success',
                "message" => "Berhasil menyimpan data",
                "data" => $this->mahasiswa->getMahasiswa($nrp)
            ]);
        }else{
            return $this->respond([
                'http_code' => 401,
                'status' => 'error',
                "message" => "Gaggal menyimpan data",
                "data" => []
            ],401);
        }

    }

    public function editPresensi(){
        $nrp  = $this->request->getPost('nrp');
        $sesi  = $this->request->getPost('sesi');
        $status  = $this->request->getPost('status');

        $dataPresensi = [
            $sesi => $status,
        ];
 
        $editPresensi = $this->presensi->updatePresensi($dataPresensi, $nrp);

            if($editPresensi == true){
                $output = [
                    'status' => 200,
                    'message' => 'Failed'
                ];
                return $this->respond($output, 200);
            } else {
                $output = [
                    'status' => 400,
                    'message' => 'Gagal update data'
                ];
                return $this->respond($output, 400);
            }
 
        
    }

    public function getBySesi()
    {
        $kode_sesi = $this->request->getPost("kode_sesi");
        $dataMhs = $this->presensi->getMshPresensi($kode_sesi);

        if($dataMhs){
            $output = [
                'status' => 200,
                'message' => 'Success',
                'data' => $dataMhs
            ];
            return $this->respond($output, 200);
        } else {
            $output = [
                'status' => 400,
                'message' => 'Gagal ngload data',
                'data' => []
            ];
            return $this->respond($output, 400);
        }
    }

    public function test(){
        // var_dump($this->jadwal->getSesi(["kode_sesi" => 2])->kode_jadwal);
        // var_dump(explode("+",$this->jadwal->getJadwalAllBy(["kode_jadwal"=> $this->jadwal->getSesi(["kode_sesi" => 2])->kode_jadwal])[0]->kelas_jadwal));
        $kelas_jadwal = [
                "2KA-01",
                "2KA-02",
                "2KA-03"
            ];
        echo count($kelas_jadwal);
        for($i=0;$i < count($kelas_jadwal);$i++){

                $dump = [];
                if("2KA-03" == $kelas_jadwal[$i]){
                    echo "INPUT DATA";
                    break;
                }else{
                    echo "GAGAL INPUT";
                }
                // echo json_encode([
                //     "iterasi" => $i,
                //     "kelas" => "2KA-03",
                //     "kelas_jadwal"=> $kelas_jadwal,
                //     "jika" => ("2KA-03" == $kelas_jadwal[$i])
                // ]);
        }
    }
}