<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['users'] = $this->UserModel->get_all_users();
        $this->load->view('users/index', $data);
    }

    public function save() {
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[2]|max_length[70]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required|numeric|min_length[10]|max_length[15]');

        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['status' => 'error', 'errors' => $errors]));
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone')
            );

            $insert = $this->UserModel->insert($data);

            if ($insert) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(['status' => 'success', 'message' => 'User added successfully']));
            } else {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(['status' => 'error', 'message' => 'Failed to add user']));
            }
        }
    }

    public function get_users_json(){
        $users = $this->UserModel->get_all_users();
        $this->output->set_content_type('application/json')->set_output(json_encode($users));
    }

    public function get_user($id) {
        $this->load->model('UserModel');
        $user = $this->UserModel->get($id);
        if ($user) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($user));
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['status' => 'error', 'message' => 'User not found']));
        }
    }

    public function update() {
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[2]|max_length[70]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required|numeric|min_length[10]|max_length[15]');
        $this->form_validation->set_rules('ID', 'ID', 'required|numeric');
    
        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['status' => 'error', 'errors' => $errors]));
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone')
            );
    
            $id = $this->input->post('ID');
            $update = $this->UserModel->update($id, $data);
    
            if ($update) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(['status' => 'success', 'message' => 'User updated successfully']));
            } else {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(['status' => 'error', 'message' => 'Failed to update user']));
            }
        }
    }
    
    public function delete($id) {
        if ($id) {
            $result = $this->UserModel->delete($id);
            if ($result) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to delete user']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid ID']);
        }
    }
    
}
