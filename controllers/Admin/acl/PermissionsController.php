<?php


class PermissionsController extends Controller
{

    public function index()
    {
            $data['permissions'] = Permission::index();
            $data['title'] = 'Admin Permissions List Page ';
            $this->_view->render('admin/permissions/index', $data);
    }

    public function delete($vars)
    {

        extract($vars);

        if (isset($_POST['submit'])) {
            Permission::destroy($id);
            header('Location: /admin/permissions');
        }
        $data['title'] = 'Admin Permission Delete Page ';
        $data['permission_id'] = $id;

        $this->_view->render('admin/permissions/delete', $data);

    }

    public function create()
    {

        if (isset($_POST) and !empty($_POST)) {
            $options['name'] = trim(strip_tags($_POST['name']));

            Permission::store($options);
            header('Location: /admin/permissions');
        }
        $data['title'] = 'Admin Permission Add Page ';

        $this->_view->render('admin/permissions/create', $data);

    }

    public function edit($vars)
    {

        extract($vars);

        $permission = Permission::get($id);

        if (isset($_POST) and !empty($_POST)) {
            $options['name'] = trim(strip_tags($_POST['name']));

            Permission::update($id, $options);

            header('Location: /admin/permissions');
        }
        $data['title'] = 'Admin Permission Edit Page ';
        $data['permission'] = $permission;

        $this->_view->render('admin/permissions/edit', $data);

    }
}
