<?php

namespace MyApp\ParcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MyAppParcBundle:Default:index.html.twig');
    }
}
