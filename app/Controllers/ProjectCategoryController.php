<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\ProjectCategoryModel as ProjectCategory;
use App\Models\ProjectModel as Project;

class ProjectCategoryController extends BaseController
{
  protected $model;
  public function __construct()
  {
    $this->model = new ProjectCategory();
  }
  public function index()
  {
    $data['title']      = 'Project Category - ' . setting('App.sitename');
    $data['categories'] = (new ProjectCategory())->select('rnd_projects_categories.*, COUNT(rnd_projects.category_id) AS project_count')
      ->join('rnd_projects', 'rnd_projects_categories.id = rnd_projects.category_id', 'left')
      ->groupBy('rnd_projects_categories.id, rnd_projects_categories.name')
      ->findAll();
    return view('v_dashboard/project/category/index', $data);
  }

  public function create()
  {
    $validationRules = [
      'name'  => [
        'label' => 'Category',
        'rules' => 'required|is_unique[rnd_projects_categories.name]',
        'errors' => [
          'required'    => '{field} is required',
          'is_unique'   => '{field} ({value}) already exists',
        ]
      ]
    ];

    if (!$this->validate($validationRules)) {
      return redirect()->to(base_url('dashboard/project/category'))->withInput()->with('error', $this->validator->getErrors());
    }

    $newCategory = [
      'name'  => $this->request->getPost('name'),
    ];

    $this->model->insert($newCategory);
    return redirect()->to(base_url('dashboard/project/category'))->with('success', "Category ({$newCategory['name']}) has been added!");
  }

  public function update($id)
  {
    $projectcategory = $this->model->find($id);
    if (!$projectcategory) {
      return redirect()->to(base_url('dashboard/project/category'))->with('error', "Project Category not found!");
    }
    $validationRules = [
      'name'  => [
        'label' => 'Category',
        'rules' => "required|is_unique[rnd_projects_categories.name,id,$id]",
        'errors' => [
          'required'    => '{field} is required',
          'is_unique'   => '{field} ({value}) already exists',
        ]
      ]
    ];

    if (!$this->validate($validationRules)) {
      return redirect()->to(base_url('dashboard/project/category'))->withInput()->with('error', $this->validator->getErrors());
    }

    $categoryData = ['name' => $this->request->getPost('name')];
    $this->model->update($id, $categoryData);
    return redirect()->to(base_url('dashboard/project/category'))->with('success', "Category ({$categoryData['name']}) has been updated!");
  }

  public function delete($id)
  {
    $category = $this->model->select('COUNT(rnd_projects.category_id) AS project_count')
      ->join('rnd_projects', 'rnd_projects_categories.id = rnd_projects.category_id', 'left')
      ->groupBy('rnd_projects_categories.id')
      ->where('rnd_projects_categories.id', $id)
      ->first()['project_count'];

    if ($category > 0) {
      return redirect()->to(base_url('dashboard/project/category'))->with('error', "Category has {$category} project(s)!");
    }

    $this->model->delete($id);
    return redirect()->to(base_url('dashboard/project/category'))->with('success', "Category ({$category['name']}) has been deleted!");
  }
}
