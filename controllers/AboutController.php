<?php

class AboutController extends Controller
{
    public function index()
    {
      $data['title'] = 'About <b>Our Cats</b>';
      $data['subtitle'] = 'Lorem Ipsum не є випадковим набором літер';
      $this->_view->render('home/about', $data);

    }

}
