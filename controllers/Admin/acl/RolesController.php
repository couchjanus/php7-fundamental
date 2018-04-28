<?php


class RolesController extends Controller
{

    public function index()
    {
        $data['roles'] = Role::index();
        $data['title'] = 'Admin Role List ';
        $this->_view->render('admin/roles/index', $data);
    }

    public function delete($vars)
    {
        extract($vars);
        if (isset($_POST['submit'])) {
            Role::delete($id);
            header('Location: /admin/roles');
        }
        $data['title'] = 'Admin Role Delete Page ';
        $data['role_id'] = $id;

        $this->_view->render('admin/roles/delete', $data);

    }

    public function create()
    {
        if (isset($_POST) and !empty($_POST)) {
            $options['name'] = trim(strip_tags($_POST['name']));

            Role::store($options);
            header('Location: /admin/roles');
        }
        $data['title'] = 'Admin Role Add ';
       
        $this->_view->render('admin/roles/create', $data);
        
    }

    public function edit($vars)
    {
        extract($vars);
        $role = Role::getRoleById($id);

        if (isset($_POST) and !empty($_POST)) {
            $options['name'] = trim(strip_tags($_POST['name']));
            Role::update($id, $options);
            header('Location: /admin/roles');
        }
        $data['title'] = 'Admin Role Edit ';
        $data['role'] = $role;
        $this->_view->render('admin/roles/edit', $data);

    }
}
