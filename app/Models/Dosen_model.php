<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class Dosen_model extends Model{
    protected $table = "dosen";
 
    public function getDosen($id = "")
    {
        if($id === ""){
            return $this->table('dosen')
                        ->get()
                        ->getResultArray();
        } else {
            return $this->table('dosen')
                        ->where('nip_dosen', $id)
                        ->get()
                        ->getRowArray();
        }   
    } 
}