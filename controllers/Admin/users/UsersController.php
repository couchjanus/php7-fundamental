<?php

class UsersController extends Controller
{

    public function index()
    {
        $data['users'] = User::index();
        $data['title'] = 'Admin User List ';
        $this->_view->render('admin/users/index', $data);
    }


    public function delete($vars)
    {
        extract($vars);
        if (isset($_POST['submit'])) {
            User::destroy($id);
            $this->redirect('/admin/users');
          
        } elseif (isset($_POST['reset'])) {
            $this->redirect('/admin/users');            
        }

        $data['title'] = 'Admin Delete User ';
        $data['post'] = User::getUserById($id);
        $this->_view->render('admin/users/delete', $data);
    }


    public function create()
    {

        if (isset($_POST) and !empty($_POST)) {
            $options['name'] = trim(strip_tags($_POST['name']));
            $options['email'] = trim(strip_tags($_POST['email']));
            $options['role'] = $_POST['role'];
            $options['password'] = trim(strip_tags($_POST['password']));
            User::store($options);
            $this->redirect('/admin/users');   
        }
        $data['title'] = 'Admin Create User ';
        $data['roles'] = Role::index();
        $this->_view->render('admin/users/create', $data);
        
    }

    
    public function edit($vars)
    {
        
        extract($vars);

        $user = User::getUserById($id);

        if (isset($_POST) and !empty($_POST)) {
            $options['name'] = trim(strip_tags($_POST['name']));
            $options['email'] = trim(strip_tags($_POST['email']));
            $options['password'] = trim(strip_tags($_POST['password']));
            $options['role'] = $_POST['role'];
            $options['status'] = $_POST['status'];
            User::edit($id, $options);
            header('Location: /admin/users');
        }
        $data['title'] = 'Admin User Edit Page ';
        $data['roles'] = Role::index();
        $data['user'] = $user;
        
        $this->_view->render('admin/users/edit', $data);

    }
}
