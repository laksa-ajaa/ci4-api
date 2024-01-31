<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
  protected $table            = 'rnd_projects';
  protected $primaryKey       = 'id';
  protected $useAutoIncrement = true;
  protected $returnType       = 'array';
  protected $useSoftDeletes   = false;
  protected $protectFields    = true;
  protected $allowedFields    = ['name', 'category_id', 'description', 'link', 'link_github', 'image', 'is_featured'];

  // Dates
  protected $useTimestamps = true;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  // Validation
  protected $skipValidation       = false;
  protected $cleanValidationRules = true;

  public function getPhoto($photoName)
  {
    return base_url('assets/img/project/' . $photoName);
  }
}
