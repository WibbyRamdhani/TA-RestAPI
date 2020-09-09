<?php 
namespace App\Controllers;
use \Firebase\JWT\JWT;
use App\Models\Dosen_model;
use CodeIgniter\RESTful\ResourceController;

class Dosen extends ResourceController
{
    public function __construct()
    {
        $this->dosen = new Dosen_model();
    }

    public function index()
    {
       $nip_dosen  = $this->request->getPost('nip_dosen') ? $this->request->getPost('nip_dosen') : "";
        return $this->respond($this->dosen->getDosen($nip_dosen));
    }

}