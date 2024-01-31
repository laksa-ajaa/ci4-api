<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\ProjectModel as Project;
use App\Models\ProjectCategoryModel as ProjectCategory;
use App\Models\ProjectTechStacksModel as ProjectTechStacks;
use App\Models\TechStacksModel as TechStacks;

class ProjectController extends BaseController
{
  protected $model;

  public function __construct()
  {
    $this->model = new Project();
  }

  public function index()
  {
    $data['title']    = 'Project - ' . setting('App.sitename');
    $data['projects'] = $this->model->select("rnd_projects.*, rnd_projects_categories.name AS category_name, GROUP_CONCAT(CONCAT_WS(',',rnd_techstacks.name)) AS techstack_name")->join('rnd_projects_categories', 'rnd_projects.category_id = rnd_projects_categories.id')->join('rnd_projects_techstacks', 'rnd_projects.id = rnd_projects_techstacks.project_id')->join('rnd_techstacks', 'rnd_projects_techstacks.techstack_id = rnd_techstacks.id')->groupBy('rnd_projects.id')->orderBy('rnd_projects.updated_at', 'DESC')->findAll();
    return view('v_dashboard/project/index', $data);
  }

  public function new()
  {
    $data['title']              = "Add Project - " . setting('App.sitename');
    $data['project_categories'] = (new ProjectCategory())->findAll();
    $data['techstacks']         = (new TechStacks)->findAll();
    return view('v_dashboard/project/create', $data);
  }

  public function create()
  {
    $validationRules = [
      'name'        => [
        'label' => 'Project Name',
        'rules' => 'required|min_length[3]|max_length[255]',
        'errors' => [
          'required'    => '{field} is required',
          'min_length'  => '{field} must be at least {param} characters long',
          'max_length'  => '{field} must not exceed {param} characters long',
        ]
      ],
      'category_id' => 'required',
      'description' => 'required',
      'link'        => 'valid_url_strict|permit_empty',
      'link_github' => 'valid_url_strict|permit_empty',
      'photo'       => 'uploaded[photo]|max_size[photo,10240]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]',
      'techstack'   => 'required|is_array',
      'techstack.*' => 'required|integer',
      'is_featured' => 'permit_empty'
    ];

    if (!$this->validate($validationRules)) {
      return redirect()->to(base_url('dashboard/project/new'))->withInput()->with('error', $this->validator->getErrors());
    }

    $projectData = [
      'name'        => $this->request->getPost('name'),
      'category_id' => $this->request->getPost('category_id'),
      'description' => $this->request->getPost('description'),
      'link'        => $this->request->getPost('link') == '' ? null : $this->request->getPost('link'),
      'link_github' => $this->request->getPost('link_github') == '' ? null : $this->request->getPost('link_github'),
      'is_featured' => $this->request->getPost('is_featured') == 'on' ? 1 : 0,
    ];

    if ($this->request->getFile('photo')->isValid()) {
      $photo = $this->request->getFile('photo');
      $photoName = $this->generateProjectImage($photo);
      $projectData['image'] = $photoName;
    }

    $project = $this->model->insert($projectData);
    $projectTechStackModel = new ProjectTechStacks();
    $techstacks = $this->request->getPost('techstack');
    foreach ($techstacks as $techstack) {
      $projectTechStackModel->insert([
        'project_id'    => $project,
        'techstack_id'  => $techstack,
      ]);
    }
    return redirect()->to(base_url('dashboard/project'))->with('success', "Project ({$projectData['name']}) has been added!");
  }

  public function edit($id)
  {
    $project = $this->model->find($id);
    if (!$project) {
      return redirect()->to(base_url('dashboard/project'))->with('error', 'Project not found!');
    }
    $data['title']              = "Edit Project: {$project['name']} - " . setting()->get('App.sitename');
    $data['project']            = $this->model->select("rnd_projects.*, GROUP_CONCAT(rt.id SEPARATOR ',') AS techstacks_id")->join('rnd_projects_techstacks AS rpt', 'rnd_projects.id = rpt.project_id')->join('rnd_techstacks AS rt', 'rpt.techstack_id = rt.id')->where('rnd_projects.id', $id)->groupBy('rnd_projects.id')->first();
    $data['project_categories'] = (new ProjectCategory())->findAll();
    $data['techstacks']         = (new TechStacks)->findAll();
    return view('v_dashboard/project/edit', $data);
  }

  public function update($id)
  {
    $project = $this->model->find($id);
    if (!$project) {
      return redirect()->to(base_url('dashboard/project'))->with('error', 'Project not found!');
    }

    $validationRules = [
      'name'        => [
        'label' => 'Project Name',
        'rules' => 'required|min_length[3]|max_length[255]',
        'errors' => [
          'required'    => '{field} is required',
          'min_length'  => '{field} must be at least {param} characters long',
          'max_length'  => '{field} must not exceed {param} characters long',
        ]
      ],
      'category_id' => 'required',
      'description' => 'required',
      'link'        => 'valid_url_strict|permit_empty',
      'link_github' => 'valid_url_strict|permit_empty',
      'photo'       => 'permit_empty|max_size[photo,10240]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]',
      'techstack'   => 'required|is_array',
      'techstack.*' => 'required|integer',
      'is_featured' => 'permit_empty'
    ];

    if (!$this->validate($validationRules)) {
      return redirect()->to(base_url("dashboard/project/edit/{$project['id']}"))->withInput()->with('error', $this->validator->getErrors());
    }

    $data = [
      'name'        => $this->request->getPost('name'),
      'category_id' => $this->request->getPost('category_id'),
      'description' => $this->request->getPost('description'),
      'link'        => $this->request->getPost('link') == '' ? null : $this->request->getPost('link'),
      'link_github' => $this->request->getPost('link_github') == '' ? null : $this->request->getPost('link_github'),
      'is_featured' => $this->request->getPost('is_featured') == 'on' ? 1 : 0,
    ];

    if ($this->request->getFile('photo')->isValid()) {
      if (file_exists('assets/img/project/' . $project['image'])) {
        unlink('assets/img/project/' . $project['image']);
      }
      $photo = $this->request->getFile('photo');
      $photoName = $this->generateProjectImage($photo);
      $data['image'] = $photoName;
    }

    $project = $this->model->update($id, $data);
    $projectTechStackModel = new ProjectTechStacks();
    $projectTechStackModel->where('project_id', $id)->delete();
    $techstacks = $this->request->getPost('techstack');
    foreach ($techstacks as $techstack) {
      $projectTechStackModel->insert([
        'project_id'    => $project,
        'techstack_id'  => $techstack,
      ]);
    }
    return redirect()->to(base_url('dashboard/project'))->with('success', "Project ({$data['name']}) has been updated!");
  }

  public function delete($id)
  {
    $project = $this->model->find($id);
    if (!$project) {
      return redirect()->to(base_url('dashboard/project'))->with('error', 'Project not found!');
    }
    if (file_exists('assets/img/project/' . $project['image'])) {
      unlink('assets/img/project/' . $project['image']);
    }
    $this->model->delete($id);
    return redirect()->to(base_url('dashboard/project'))->with('success', 'Project has been deleted!');
  }

  public function generateProjectImage($photo, $photoName = null)
  {
    if (is_null($photoName)) {
      $photoName = uniqid() . '.webp';
    }
    $photoWebP = \Config\Services::image();
    $photoWebP->withFile($photo);

    $width = $photoWebP->getWidth();
    if ($width > 1280) {
      $height = round(1280 / ($width / $photoWebP->getHeight()));
      $photoWebP->resize(1280, $height, true);
    }

    $photoWebP->convert(IMAGETYPE_WEBP);
    $photoWebP->save('assets/img/project/' . $photoName, 80);
    return $photoName;
  }

  // Project API
  public function indexjson()
  {
    $image_path = base_url('assets/img/project/');

    // Get all projects
    $projects = $this->model->select("rnd_projects.id,rnd_projects.name,rnd_projects_categories.name as category,rnd_projects.description, CONCAT('$image_path',rnd_projects.image) AS image,rnd_projects.link,rnd_projects.link_github,rnd_projects.is_featured")->join('rnd_projects_categories', 'rnd_projects_categories.id = rnd_projects.category_id');
    if ($this->request->getGet('featured') == '1') {
      $projects->where('rnd_projects.is_featured', 1);
    }
    $projects->orderBy('rnd_projects.created_at', 'DESC');
    $projects = $projects->findAll();

    if (empty($projects)) {
      return $this->response->setJSON([]);
    }

    // Get project id
    $projects_id = array_map(fn ($project) => $project['id'], $projects);

    // Convert is_featured to boolean
    $projects = array_map(function ($p) {
      $p['is_featured'] = $p['is_featured'] == 1 ? true : false;
      return $p;
    }, $projects);

    // Get all techstacks by project id
    $techstacks = (new ProjectTechStacks())
      ->select("rnd_projects_techstacks.project_id, rnd_techstacks.name, CONCAT('$image_path',rnd_techstacks.image) AS image")
      ->join('rnd_techstacks', 'rnd_techstacks.id = rnd_projects_techstacks.techstack_id')
      ->whereIn('rnd_projects_techstacks.project_id', $projects_id)->findAll();

    // Group techstacks by project_id
    $projects = array_map(function ($project) use ($techstacks) {
      $project['techstacks'] = array_values(array_filter($techstacks, function ($techstack) use ($project) {
        return $techstack['project_id'] == $project['id'];
      }));

      $project['techstacks'] = array_map(function ($techstack) {
        unset($techstack['project_id']);
        return $techstack;
      }, $project['techstacks']);

      return $project;
    }, $projects);

    // Remove id from projects array
    $projects = array_map(function ($p) {
      unset($p['id']);
      return $p;
    }, $projects);

    return $this->response->setJSON($projects);
  }
}
