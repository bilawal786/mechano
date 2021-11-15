<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class UpdateApplicationController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = __('menu.updateApplication');
        $this->pageIcon = __('ti-settings');
    }

    public function index()
    {
        return view('admin.update-application.index');
    }

}
