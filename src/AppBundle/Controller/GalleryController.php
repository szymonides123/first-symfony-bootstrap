<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class GalleryController extends Controller
{
    public function galleryAction()
    {
        return $this->render('default/gallery.html.twig');
    }
}