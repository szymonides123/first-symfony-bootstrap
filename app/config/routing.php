<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

    $collection->add('_welcome', new Route('/', array(
        '_controller' => 'AppBundle:Home:index',
    )));
    $collection->add('home', new Route('/home', array(
        '_controller' => 'AppBundle:Home:index',
    )));
    $collection->add('contact', new Route('/contact', array(
        '_controller' => 'AppBundle:Contact:contact',
    )));
    $collection->add('galeria', new Route('/gallery', array(
        '_controller' => 'AppBundle:Gallery:gallery',
    )));
    $collection->add('cennik', new Route('/prices', array(
        '_controller' => 'AppBundle:Prices:prices',
    )));
    $collection->add('priceDelete', new Route('/prices/delete/{id}', array(
        '_controller' => 'AppBundle:Prices:delete'
    )));
    $collection->add('priceAdd', new Route('/prices/add', array(
        '_controller' => 'AppBundle:Prices:add'
    )));
    $collection->add('confirmedcontact', new Route('/contact/confirm', array(
        '_controller' => 'AppBundle:Contact:confirm'
    )));
    $collection->add('logout', new Route('/logout'));

    return $collection;