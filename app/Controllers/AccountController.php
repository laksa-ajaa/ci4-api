<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UserModel as User;

class AccountController extends BaseController
{
  public function index()
  {
    $data['user'] = (new User())->find(auth()->user()->id);
    $data['title'] = 'Account - ' . setting('App.sitename');
    return view('v_dashboard/account', $data);
  }

  public function edit()
  {
    $users = auth()->getProvider();
    $user = $users->findById(auth()->user()->id);
    $validationRules = [
      'name'      => "required|min_length[3]|max_length[150]",
      'username'  => "required|min_length[3]|max_length[150]|is_unique[users.username,id,{$user->id}]",
      'email'     => "required|min_length[3]|max_length[150]|valid_email|is_unique[auth_identities.secret,user_id,{$user->id}]",
    ];

    if (!$this->validate($validationRules)) {
      return redirect()->to(base_url('dashboard/account'))->withInput()->with('error', $this->validator->getErrors());
    }

    (new User())->update($user->id, ['name' => $this->request->getPost('name')]);
    $user->fill([
      'username'  => $this->request->getPost('username'),
      'email'     => $this->request->getPost('email')
    ]);
    $users->save($user);
    return redirect()->to(base_url('dashboard/account'))->with('success', 'Profile successfully updated!');
  }

  public function editpassword()
  {
    $users = auth()->getProvider();
    $user = $users->findById(auth()->user()->id);

    $validationRules = [
      'old_password'      => "required|min_length[8]|max_length[150]",
      'new_password'      => "required|min_length[8]|max_length[150]",
      'confirm_password'  => "required|min_length[8]|max_length[150]|matches[new_password]",
    ];

    if (!$this->validate($validationRules)) {
      return redirect()->to(base_url('dashboard/account'))->withInput()->with('validation', $this->validator->getErrors());
    }

    $old_password = (string) $this->request->getPost('old_password');

    if (!password_verify($old_password, $user->password_hash)) {
      return redirect()->to(base_url('dashboard/account'))->withInput()->with('error', 'Old password is wrong');
    }

    $user->fill([
      'password' => $this->request->getPost('new_password')
    ]);
    $users->save($user);
    return redirect()->back()->with('success', 'Password updated');
  }
}
