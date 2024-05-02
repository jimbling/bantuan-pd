<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        session();
        $data = [
            'judul' => 'Dashboard',
        ];
        return view('home', $data);
    }
}
