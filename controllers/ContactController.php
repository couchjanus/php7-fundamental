<?php
class ContactController extends Controller
{
    public function index()
    {
        $data['title'] = 'Our <b>Cats Contact</b>';
        $data['subtitle'] = 'Lorem Ipsum не є випадковим набором літер';
        $this->_view->render('home/contact', $data);
    }
}
