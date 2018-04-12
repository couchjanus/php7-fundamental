<?php

class DashboardController extends Controller
{
    public function index()
    {
        $data['title'] = 'Dashboard Controller PAGE';
        $this->_view->render('admin/index', $data);
    }
}
