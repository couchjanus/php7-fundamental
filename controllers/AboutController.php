<?php

class AboutController  extends Controller
{
   
    public function index()
    {
      $data['title'] = 'About <b>Our Best Cats</b>';
      $data['subtitle'] = 'Catch my Cats';
      
      $this->_view->render('home/about', $data);
    }

}
