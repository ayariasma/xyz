<?php

namespace MyApp\ParcBundle\Controller;

use MyApp\ParcBundle\Entity\Marque;
use MyApp\ParcBundle\Form\MarqueType;
use MyApp\ParcBundle\Form\RechercheForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class MarqueController extends Controller
{
    public function AjoutAction(Request $request)
    {
        $marque= new Marque();
        if($request->getMethod()=="POST")
        {
            $x=$request->get('libelle');//$_POST['libelle']
            $y=$request->get('pays');
            $marque->setLibelle($x);
            $marque->setPays($y);
            $em=$this->getDoctrine()->getManager();
            $em->persist($marque);
            $em->flush();
            return new Response('ajout avec succés !!');
        }
        return $this->render('MyAppParcBundle:Marque:ajout.html.twig', array(
            // ...
        ));
    }
    function ajout2Action(Request $request)
    {
        $marque= new Marque();
        $form=$this->createForm(MarqueType::class,$marque);

if($form->handleRequest($request)->isValid())
{
    //var_dump($marque).die();
    $em=$this->getDoctrine()->getManager();
    $em->persist($marque);
    $em->flush();
    return new Response('ajout 2 avec succés !!');
}
        return $this->render('MyAppParcBundle:Marque:ajout2.html.twig',
            array('f'=>$form->createView()));

    }

    public function affichageAction()
    {
        $em=$this->getDoctrine()->getManager();
        $marks=$em->getRepository('MyAppParcBundle:Marque')->findAll();
        return $this->render('MyAppParcBundle:Marque:affichage.html.twig', array(
         'm'=>$marks
        ));
    }
    function deleteAction($p)
    {
        $em=$this->getDoctrine()->getManager();
        $mark=$em->getRepository('MyAppParcBundle:Marque')->find($p);
        $em->remove($mark);
        $em->flush();
        return $this->redirectToRoute('PageAffichage');
    }
function updateAction($p,Request $request)
{
    $em=$this->getDoctrine()->getManager();
    $marks=$em->getRepository('MyAppParcBundle:Marque')->find($p);
    $form=$this->createForm(MarqueType::class,$marks);
    if($form->handleRequest($request)->isValid())
    {
        $em->persist($marks);
        $em->flush();
        return $this->redirectToRoute('PageAffichage');

    }
    return $this->render('@MyAppParc/Marque/ajout2.html.twig',
        array('f'=>$form->createView()));
}
function searchAction(Request $request)
{
    $mark= new Marque();
    $form=$this->createForm(RechercheForm::class,$mark);
    $em=$this->getDoctrine()->getManager();
    $marque=$em->getRepository('MyAppParcBundle:Marque')->findAll();
    if($form->handleRequest($request)->isValid())
    {

        $marque= $em->getRepository('MyAppParcBundle:Marque')->searchMark
        ($mark->getLibelle());
    }
     return $this->render('@MyAppParc/Marque/recherche.html.twig'
      ,array('f'=>$form->createView(),'m'=>$marque));
    }


    function searchAjaxAction(Request $request)
    {
        $marque =new Marque();
        $em = $this->getDoctrine()->getManager();
        $marques=$em->getRepository('MyAppParcBundle:Marque')->findAll();
        $Form = $this->createForm(RechercheForm::class, $marque);
        $Form->handleRequest($request);

        if($request->isXmlHttpRequest()){
            $marques=$em->getRepository('MyAppParcBundle:Marque')->searchMarque($request->get('libelle'));
            $serialize= new Serializer(array(new ObjectNormalizer()));
            $data= $serialize->normalize($marques);
            return new JsonResponse($data);
        }

        return $this->render(
            'MyAppParcBundle:Marque:recherche2.html.twig',
            array("marques" => $marques,
                  "form" => $Form->createView()));
    }

}
