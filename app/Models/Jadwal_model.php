<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class Jadwal_model extends Model{
    protected $table = "jadwal";
 
    public function getJadwal($id = "")
    {
        if($id === ""){
            return $this->table('jadwal')
                        ->get()
                        ->getResult();
        } else {
            return $this->table('jadwal')
                        ->where('kode_jadwal', $id)
                        ->get()
                        ->getRowArray();
        }   
    } 

    public function getJadwalAllBy($array)
    {
        return $this->db->table($this->table)
                        ->where($array)
                        ->get()->getResult();
    } 

    public function getMatkul($id = "")
    {
        if($id === ""){
            return $this->db->table('matkul')
                        ->get()
                        ->getResult();
        
        } else {
            return $this->db->table('matkul')
                        ->where('kode_matkul', $id)
                        ->get()
                        ->getRow();
        }   
    }

    public function getSesi($param = null)
    {
        $namaTabel = $this->db->table('sesi');
        if ($param === null) {
            return $namaTabel->get()->getResult();
        }else{
            return $namaTabel->where($param)->get()->getRow();
        }
    }

    public function getSesiBy($param)
    {
        return $this->db->table('sesi')->where($param)->get()->getResult();
    }
}