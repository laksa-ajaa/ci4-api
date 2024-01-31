<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\TechStacksModel as TechStacks;

class ProjectTechStacksController extends BaseController
{
  protected $model;
  public function __construct()
  {
    $this->model = new TechStacks();
  }
  public function index()
  {
    $data['title']     = 'Project Techstacks - ' . setting('App.sitename');
    $data['techstacks'] = $this->model->select('rnd_techstacks.*, COUNT(rnd_projects_techstacks.project_id) AS count_project')
      ->join('rnd_projects_techstacks', 'rnd_projects_techstacks.techstack_id = rnd_techstacks.id', 'left')
      ->groupBy('rnd_techstacks.id, rnd_techstacks.name')
      ->findAll();
    return view('v_dashboard/project/techstack/index', $data);
  }

  public function create()
  {
    $validationRules = [
      'name'  => [
        'label' => 'Techstack Name',
        'rules' => 'required|is_unique[rnd_techstacks.name]',
        'errors' => [
          'required'    => '{field} is required',
          'is_unique'   => '{field} ({value}) already exists',
        ]
      ],
      'image' => [
        'label' => 'Techstack Image',
        'rules' => 'uploaded[image]|max_size[image,4096]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'uploaded'    => '{field} is required',
          'max_size'    => '{field} size is too large (max: 4MB)',
          'is_image'    => '{field} is not an image',
          'mime_in'     => '{field} is not an image',
        ]
      ]
    ];

    if (!$this->validate($validationRules)) {
      return redirect()->to(base_url('dashboard/project/techstack'))->withInput()->with('error', $this->validator->getErrors());
    }

    $newTechStack = ['name'  => $this->request->getPost('name')];
    if ($this->request->getFile('image')->isValid()) {
      $newTechStack['image'] = $this->generateTechstackImage($this->request->getFile('image'), "{$newTechStack['name']}.webp");
    }

    $this->model->insert($newTechStack);
    return redirect()->to(base_url('dashboard/project/techstack'))->with('success', "Techstack ({$newTechStack['name']}) has been added!");
  }

  public function update($id)
  {
    $techstack = $this->model->find($id);
    if (!$techstack) {
      return redirect()->to(base_url('dashboard/project/techstack'))->with('error', "Techstack not found!");
    }
    $validationRules = [
      'name'  => [
        'label' => 'Techstack Name',
        'rules' => 'required|is_unique[rnd_techstacks.name,id,' . $this->request->getPost('id') . ']',
        'errors' => [
          'required'    => '{field} is required',
          'is_unique'   => '{field} ({value}) already exists',
        ]
      ],
      'image' => [
        'label' => 'Techstack Image',
        'rules' => 'max_size[image,4096]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'max_size'    => '{field} size is too large (max: 4MB)',
          'is_image'    => '{field} is not an image',
          'mime_in'     => '{field} is not an image',
        ]
      ]
    ];

    if (!$this->validate($validationRules)) {
      return redirect()->to(base_url('dashboard/project/techstack'))->withInput()->with('error', $this->validator->getErrors());
    }

    $techstackData = ['name'  => $this->request->getPost('name')];
    if ($this->request->getFile('image')->isValid()) {
      if (file_exists(ROOTPATH . 'public/assets/img/techstacks/' . $techstack['image']) && !is_null($techstack['image'])) {
        unlink(ROOTPATH . 'public/assets/img/techstacks/' . $techstack['image']);
      }
      $techstackData['image'] = $this->generateTechstackImage($this->request->getFile('image'), "{$techstackData['name']}.webp");
    }

    $this->model->update($id, $techstackData);
    return redirect()->to(base_url('dashboard/project/techstack'))->with('success', "Techstack ({$techstackData['name']}) has been updated!");
  }

  public function delete($id)
  {
    $techstack = $this->model->find($id);
    if ($techstack) {
      if (file_exists(ROOTPATH . 'public/assets/img/techstacks/' . $techstack['image']) && !is_null($techstack['image'])) {
        unlink(ROOTPATH . 'public/assets/img/techstacks/' . $techstack['image']);
      }
      $this->model->delete($id);
      return redirect()->to(base_url('dashboard/project/techstack'))->with('success', "Techstack {$techstack['name']} has been deleted!");
    }
    return redirect()->to(base_url('dashboard/project/techstack'))->with('error', "Techstack not found!");
  }

  public function generateTechstackImage($photo, $photoName = null)
  {
    if (is_null($photoName)) {
      $photoName = uniqid() . '.webp';
    }
    $photoName = str_replace(' ', '-', strtolower($photoName));
    $photoWebP = \Config\Services::image();
    $photoWebP->withFile($photo);

    $width = $photoWebP->getWidth();
    if ($width > 500) {
      $height = round(500 / ($width / $photoWebP->getHeight()));
      $photoWebP->resize(500, $height, true);
    }

    $photoWebP->convert(IMAGETYPE_WEBP);
    $photoWebP->save(ROOTPATH . 'public/assets/img/techstacks/' . $photoName, 80);
    return $photoName;
  }
}
