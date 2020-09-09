<?php namespace App\Models;

use CodeIgniter\Model;

class Presensi_model extends Model
{
    protected $table = "presensi";

    public function getPresensi($id = "") 
    {
        if($id === ""){
            return $this->table('presensi')
                        ->get()
                        ->getResultArray();
        } else {
            return $this->table('presensi')
                        ->where('kode_presensi', $id)
                        ->get()
                        ->getRowArray();
        }   
    }
    
    public function getPresensiBy($param)
    {
        return $this->db->table($this->table)->where($param)->get()->getRow();
    }

    public function add($param)
    {
            if (!$this->getPresensiBy(['kode_sesi' => $param['kode_sesi'], 'nrp'=>$param['nrp']])) {
                $result = $this->db->table($this->table)->insert($param);
                return true;
            }else{
                return false;
            }
            
            // return ($this->db->error()) ? true : false;
    }

    public function getMshPresensi($kode_sesi = null)
    {
        $this->select("
            sesi.kode_sesi,
            presensi.nrp,
            mahasiswa.nama,
            mahasiswa.kelas
            ",false);
        $this->db->table("presensi");
        $this->join("sesi", "presensi.kode_sesi = sesi.kode_sesi");
        $this->join("mahasiswa", "presensi.nrp = mahasiswa.nrp");
        $this->where("sesi.kode_sesi",$kode_sesi);
        // return $this->db->query("SELECT
        //     sesi.kode_sesi,
        //     presensi.nrp,
        //     mahasiswa.nama,
        //     mahasiswa.kelas
        //     FROM
        //     presensi
        //     INNER JOIN sesi ON presensi.kode_sesi = sesi.kode_sesi
        //     INNER JOIN mahasiswa ON presensi.nrp = mahasiswa.nrp")->getResult();
        $qry = $this->get();
        return $qry->getResult();
    }
}