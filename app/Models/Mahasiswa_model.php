<?php namespace App\Models;

use CodeIgniter\Model;

class Mahasiswa_model extends Model
{
    protected $table = "mahasiswa";
    protected $pk = "nrp";

    public function getMahasiswa($id = "")
    {
        if($id === ""){
            return $this->table('mahasiswa')
                        ->get()
                        ->getResultArray();
        } else {
            return $this->table('mahasiswa')
                        ->where('nrp', $id)
                        ->get()
                        ->getRowArray();
        }   
    }
    
    public function cariMHS($id)
    {
        return ($this->db->table($this->table)->where($this->pk,$id)->get()->getRow());
    }

    public function getMhsAllBy($data)
    {
        return ($this->db->table($this->table)->where($data)->get()->getResult());
    }

    public function addMahasiswa($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateMahasiswa($data, $id)
    {
        return $this->db->table($this->table)->update($data, " nrp = $id ");
    }

    public function deleteMahasiswa($id)
    {
        return $this->db->table($this->table)->delete(" nrp = $id ");
    }
}