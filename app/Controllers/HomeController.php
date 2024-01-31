<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use \Config\Database as DB;
use App\Models\ContactModel as Contact;
use App\Models\ProjectModel as Project;

class HomeController extends BaseController
{
  public function dashboard()
  {
    $data['title'] = "Dashboard - " . setting()->get('App.sitename');
    $countDashboard = DB::connect()->query('SELECT (SELECT COUNT(*) FROM rnd_projects) AS count_projects, (SELECT COUNT(*) FROM rnd_contacts) AS count_contacts, (SELECT COUNT(*) FROM users) as count_user')->getRowArray();
    $data['data'] = [
      'Project' => [
        'count' => $countDashboard['count_projects'],
        'icon' => 'ri-apps-2-line',
        'url' => base_url('dashboard/project'),
      ],
      'Contact Response' => [
        'count' => $countDashboard['count_contacts'],
        'icon' => 'ri-contacts-book-3-line',
        'url' => base_url('dashboard/contact'),
      ],
      'PHP Version' => [
        'count' => phpversion(),
        'icon' => 'ri-question-mark',
        'url' => base_url('dashboard/phpinfo'),
      ],
      'User' => [
        'count' => $countDashboard['count_user'],
        'icon' => 'ri-user-3-line',
        'url' => base_url('dashboard/user'),
      ],
    ];

    $data['recent_contacts'] = (new Contact)->orderBy('created_at', 'DESC')->limit(4)->get()->getResultArray();
    return view('v_dashboard/dashboard', $data);
  }

  // PHPInfo
  public function phpinfo_index()
  {
    $data['title'] = "PHPInfo - " . setting()->get('App.sitename');
    return view('v_dashboard/phpinfo', $data);
  }

  public function phpinfo_iframe()
  {
    phpinfo();
  }

  public function cv()
  {
    $data['title'] = "Rendio Simamora - CV";
    return view('v_dashboard/cv', $data);
  }
}
