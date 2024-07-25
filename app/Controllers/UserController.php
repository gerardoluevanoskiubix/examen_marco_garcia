<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;

class UserController extends ResourceController
{

    protected $helpers = ['form'];

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();
        
        if ($this->request->getGet('json') === 'true') {
            return $this->response->setJSON($data['users']);
        }

        return view('users/index.php', $data);
    }
    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        if ($id === null) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'User not found']);
        }
    
        $userModel = new UserModel();
        $user = $userModel->find($id);
    
        if ($user === null) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'User not found']);
        }
    
        return $this->response->setJSON($user);
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        return view('users/newUser');
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $rules = [
            'name' => 'required|min_length[2]|max_length[70]',
            'email' => 'required|valid_email',
            'phone' => 'required|numeric|min_length[10]|max_length[15]',
        ];
    
        if (!$this->validate($rules)) {
            $errors = $this->validator->listErrors();
            if ($this->request->isAJAX()) {
                return $this->response->setStatusCode(400)->setJSON(['status' => 'error', 'errors' => $errors]);
            } else {
                return redirect()->back()->withInput()->with('error', $errors);
            }
        }
    
        $post = $this->request->getPost(['name', 'email', 'phone']);
    
        $userModel = new UserModel();
        $userModel->insert([
            'name' => trim($post['name']),
            'email' => trim($post['email']),
            'phone' => $post['phone'],
        ]);
    
        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'User added successfully', 'redirect' => base_url('users')]);
        } else {
            return redirect()->to('users')->with('message', 'User added successfully');
        }
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {

        if($id == null){
            return redirect()->to('users');
        }

        $userModel = new UserModel();
        $data['user'] = $userModel->find($id);
        return view('users/editUser', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        if ($id == null) {
            return redirect()->to('users');
        }
    
        $rules = [
            'name' => 'required|min_length[2]|max_length[70]',
            'email' => 'required|valid_email',
            'phone' => 'required|numeric|min_length[10]|max_length[15]',
        ];
    
        if (!$this->validate($rules)) {
            $errors = $this->validator->listErrors();
            if ($this->request->isAJAX()) {
                return $this->response->setStatusCode(400)->setJSON(['status' => 'error', 'errors' => $errors]);
            } else {
                return redirect()->back()->withInput()->with('error', $errors);
            }
        }
    
        $post = $this->request->getPost(['name', 'email', 'phone']);
    
        $userModel = new UserModel();
        $userModel->update($id, [
            'name' => trim($post['name']),
            'email' => trim($post['email']),
            'phone' => $post['phone'],
        ]);
    
        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'User updated successfully', 'redirect' => base_url('users')]);
        } else {
            return redirect()->to('users')->with('message', 'User updated successfully');
        }
    }
    

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        if ($this->request->isAJAX()) {
            if ($id === null) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid ID']);
            }
    
            $userModel = new UserModel();

            if ($userModel->delete($id)) {
                return $this->response->setJSON(['status' => 'success', 'redirect' => base_url('users')]);
            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Error deleting user']);
            }
        } else {
            return redirect()->to('users');
        }
    }
    
}
