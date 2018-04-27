<?php


class PagesController extends Controller
{
    
    public function notFound()
    {
        $this->_view->render('errors/404');
    }

}