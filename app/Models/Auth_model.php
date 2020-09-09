<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class Auth_model extends Model{
 
    protected $table = "dosen";
 
    public function register($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query ? true : false;
    }
 
    public function cek_login($nip_dosen)
    {
        $query = $this->table($this->table)
                ->where("nip_dosen", $nip_dosen)
                ->countAll();
 
        if($query > 0){
            $hasil = $this->table($this->table)
                    ->where("nip_dosen", $nip_dosen)
                    ->limit(1)
                    ->get()
                    ->getRowArray();
        } else {
            $hasil = array(); 
        }
        return $hasil;
    }
}