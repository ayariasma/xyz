<?php
/**
 * Created by PhpStorm.
 * User: Marwen
 * Date: 13/02/2018
 * Time: 10:05
 */

namespace MyApp\UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EtudiantController extends Controller
{
function testAction()
{
return new Response('hello 3a11');
}
function page2Action($name)
{
    //$name=" foulen";
    $lastName=" Ben foulen";
    return $this->render('MyAppUserBundle:Etudiant:page2.html.twig',
        array('n'=>$name,'p'=>$lastName));
}
function listEAction()
{
    $etudiants=array('Med','Houssem','Ines','Pascal','bababa');
    $listE=array(
        array('id'=>1,'nom'=>'Ben foulen','Age'=>25),
        array('id'=>2,'nom'=>'Ben Med','Age'=>15),
        array('id'=>3,'nom'=>'Med Matoussi','Age'=>35)
    );
return $this->render('@MyAppUser/Etudiant/listEtudiant.html.twig',
        array('e'=>$etudiants,'list'=>$listE));
}
function detailsAction(Request $req)
{
    $x=$req->get('id');
    $y=$req->get('nom');
    $z=$req->get('Age');
    return $this->render('@MyAppUser/Etudiant/details.html.twig',
        array('id'=>$x,'nom'=>$y,'age'=>$z));
}
}