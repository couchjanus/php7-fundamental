<?php

class HomeController extends Controller
{
    
    public function index()
    {
        $data['title'] = 'Our <b>Best Cat Members</b>';

        $this->_view->render('home/about', $data);
    }

}
