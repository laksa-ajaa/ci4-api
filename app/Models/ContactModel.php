<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactModel extends Model
{
    protected $table            = 'rnd_contacts';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name','email','message'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function getDataById($id){
      $query = $this->select("name, email, message, created_at AS timestamp, CONCAT('https://www.gravatar.com/avatar/', MD5(COALESCE(NULLIF(email, ''), 'a@rndio.my.id')), '?s=100&d=mm&r=g') as photo");
      $query->where('id', $id);

      return $query->get()->getRowArray();
    }

    public function getData($id = NULL){
      if($id == NULL){
        $query = $this->db->table($this->table)->get();
        return $query->getResultArray();
      }

      $query = $this->db->table($this->table)->getWhere(['id' => $id]);
      return $query->getRowArray();
    }

    public function deleteData($id){
      $query = $this->db->table($this->table)->delete(['id' => $id]);
      return $query;
    }


}
