<?php

namespace MyApp\ParcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VoitureController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }


}
