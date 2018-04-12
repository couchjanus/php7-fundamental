<?php

class AboutController
{
    public function __construct()
    {
      render('home/about', ['title'=>'About <b>Our Cats</b>']);
    }

    public function index()
    {

    }

}
