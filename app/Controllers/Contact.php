<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Contact as ContactModel;

class Contact extends BaseController{
  protected $model;

  public function __construct(){
    $this->model = new ContactModel();
  }

  public function index(){
    $data['title'] = 'Contact Response';
    $data['contacts'] = $this->model->orderBy('created_at', 'DESC')->findAll();
    return view('v_dashboard/contact/index', $data);
  }

  public function store(){
    $rules = [
      'name' => 'required|permit_empty',
      'email' => 'required|valid_email|permit_empty',
      'message' => 'required'
    ];

  }

    public function detail($id)
    {
        //
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
