<?php


namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;




class HomeController extends Controller
{


    public function indexAction()
    {
        return $this->render('default/home.html.twig');
    }
}

