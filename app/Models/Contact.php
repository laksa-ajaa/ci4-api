<?php

namespace App\Models;

use CodeIgniter\Model;

class Contact extends Model
{
    protected $table            = 'rnd_contacts';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

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
