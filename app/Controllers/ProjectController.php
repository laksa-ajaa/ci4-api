<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProjectModel as Project;

class ProjectController extends BaseController{
    protected $model;

    public function __construct(){
        $this->model = new Project();
    }

    public function index()
    {
      $data['title'] = 'Project';
      $data['projects'] = $this->model->orderBy('created_at', 'DESC')->findAll();
      return view('v_dashboard/project/index', $data);
    }

    public function indexjson(){
      
    }
}
