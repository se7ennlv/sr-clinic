<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HomeController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ReportModel');

        if (!$this->session->userdata('uid')) {
            redirect('AppController/LoginView');
            
            exit;
        }
    }

    public function index()
    {
        $data['alerts'] = $this->ReportModel->FindMedAlerts();
        $data['medtotal'] = $this->ReportModel->CountAllMedLowStock();

        $this->load->view('layout/header');
        $this->load->view('layout/sidebar', $data);
        $this->load->view('layout/script');
        $this->load->view('home/index');
        $this->load->view('layout/footer');
    }
}
