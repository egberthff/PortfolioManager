<?php

namespace App\Controllers;

use App\Models\ProjectModel;
use App\Helpers\DataAggregator;

class Portfolio extends BaseController
{
    // function to display the visitor home page
   public function index()
    {
        $result = DataAggregator::getAllData();

        log_message('error', json_encode($result));

        if ($result['status'] === 'success') {
            return view('home', $result['data']);
        } else {
            return view('errors/html/error_general', [
                'message' => $result['message'] ?? 'Something went wrong'
            ]);
        }
    }

    public function submitContact()
    {
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $message = $this->request->getPost('message');

        if ($name && $email && $message) {
            return redirect()->to('/contact')->with('success', 'Message sent!');
        }

        return redirect()->to('/contact')->with('error', 'All fields required.');
    }
}
