<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ContactModel as Contact;

class ContactController extends BaseController{
  use ResponseTrait;
  protected $model;

  public function __construct(){
    $this->model = new Contact();
  }

  public function index(){
    $data['title'] = 'Contact Response';
    $data['contacts'] = $this->model->orderBy('created_at', 'DESC')->paginate(10);
    $data['pager'] = $this->model->pager;
    return view('v_dashboard/contact/index', $data);
  }

  public function store(){
    $rules = [
      'name' => 'permit_empty|max_length[100]',
      'email' => 'valid_email|permit_empty|max_length[100]',
      'message' => 'required'
    ];

    if(!$this->validate($rules)){
      $response = [
        'status' => 400,
        'error' => $this->validator->getErrors()
      ];
      return $this->respond($response, 400);
    }
    
    $this->model->insert([
      'name' => esc($this->request->getPost('name')),
      'email' => esc($this->request->getPost('email')),
      'message' => esc($this->request->getPost('message'))
    ]);

    $response = [
      'status' => 201,
      'message' => 'Message sent successfully!'
    ];

    return $this->respondCreated($response, 201);
  }

    public function detail($id)
    {
      $data = $this->model->getDataById($id);
      if($data){
        $response = [
          'status' => 200,
          'data' => $data
        ];
        return $this->respond($response, 200);
      }
      $response = [
        'status' => 404,
        'message' => 'Data not found'
      ];
      return $this->respond($response, 404);
    }

    public function delete($id){
      $data = $this->model->deleteData($id);
      if($data){
        session()->setFlashdata('success', 'Data has been deleted');
        return redirect()->to(base_url('dashboard/contact'));
      }
      session()->setFlashdata('error', 'Data failed to delete');
      return redirect()->to(base_url('dashboard/contact'));
    }

    public function redirect(){
      return redirect()->to("https://www.rndio.my.id/p/contact.html");
    }

}
