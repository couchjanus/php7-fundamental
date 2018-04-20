<?php

class HomeController extends Controller
{

    public function index()
    {
        $title = 'Our <b>Best Cat Members</b>';
        $data['title'] = $title;
        $data['subtitle'] = 'Lorem Ipsum не є випадковим набором літер';
        $this->_view->render('home/index', $data);
    }

}
