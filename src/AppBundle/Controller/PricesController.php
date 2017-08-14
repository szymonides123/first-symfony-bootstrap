<?php

namespace AppBundle\Controller;

use function PHPSTORM_META\type;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Prices;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class PricesController extends Controller
{

    public function pricesAction()
    {

        $prices=$this->getDoctrine()->getRepository('AppBundle:Prices')->findAll();
        return $this->render('default/prices.html.twig', array(
            'prices' => $prices
        ));
    }

    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();
        $prices=$em->getRepository('AppBundle:Prices')->find($id);
        $em->remove($prices);
        $em->flush();
        return $this->redirectToRoute('cennik');
    }

    public function addAction(Request $request){
        $price = new Prices();

        $form = $this->createFormBuilder($price)
            ->add('name', TextType::class, array('label' => 'Nazwa'))
            ->add('price', TextType::class, array('label' => 'Cena'))
            ->add('description', TextType::class, array('label' => 'Opis'))
            ->add('save', SubmitType::class, array('label' => 'Zapisz'))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($price);
            $em->flush();
            return $this->redirectToRoute('priceAdd');
        }
        return $this->render('default/add.html.twig', array(
            'form' => $form->createView(),
        ));

    }
}
