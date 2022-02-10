<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AppController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('EmployeeModel');
        $this->load->model('AppModel');
	}

	public function LoginView()
	{
		$this->load->view('app/LoginView');
	}

	public function ExecuteLogin()
    {
        $username = $this->input->post('Username');
        $password = sha1($this->input->post('Password'));
        $data = $this->UserModel->LoginValid($username, $password);

        if (!empty($data)) {
            $userPic = $this->EmployeeModel->FindOnePic($data->EmpID);

            $setData = array(
                'user_pic' => $userPic,
                'uid' => $data->UID,
                'emp_id' => $data->EmpID,
                'username' => $data->Username,
                'fname' => $data->Fname,
                'lname' => $data->Lname,
                'level' => $data->Level,
                'created_at' => $data->CreatedAt
            );

            $this->session->set_userdata($setData);
            $this->output->set_content_type('application/json')->set_output(json_encode((array('status' => 'success', 'message' => 'Login Success'))));
        } else {
            $this->output->set_content_type('application/json')->set_output(json_encode((array('status' => 'danger', 'message' => 'Incorrect username or password'))));
            $array_items = array('user_pic' => '', 'uid' => '', 'fname' => '', 'lname' => '');
            $this->session->unset_userdata($array_items);
        }
	}
	
	public function ExecuteLogout()
    {
        $this->session->unset_userdata('uid');
        redirect('AppController/LoginView', 'refresh');
        
        exit;
    }

}
