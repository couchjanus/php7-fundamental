<?php

class HomeController
{

    public function index()
    {
        $title = 'Our <b>Best Cat Members</b>';

        require_once VIEWS.'home/index.php';
    }

}
