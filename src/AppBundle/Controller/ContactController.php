<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ContactController extends Controller
{

    public function contactAction(Request $request)
    {
        $contact= new Contact();
        $form = $this->createFormBuilder($contact)
            ->add('name', TextType::class, array('label' => 'Nazwa', 'attr'=>array('class'=>'form-control')))
            ->add('telephoneNumber', TextType::class, array('label' => 'Nr. telefonu', 'attr'=>array('class'=>'form-control')))
            ->add('email', TextType::class, array('label' => 'Adres email', 'attr'=>array('class'=>'form-control')))
            ->add('Wyslij', SubmitType::class, array('label' => 'Zapisz', 'attr'=>array('class'=>'submit-fr')))
            ->getForm();
                
        $form->handleRequest($request);
        

        if($form->isSubmitted() && $form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();

            $message = \Swift_Message::newInstance()
                ->setSubject('MARBUD: Klient prosi o kontakt')
                ->setFrom('testmail432@gmail.com')
                ->setTo('szymek283@gmail.com')
                ->setBody(
                    $this->renderView(
                        'emails/contact.html.twig',
                        array('form' => $contact)
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);


            return $this->redirectToRoute('confirmedcontact');
        }

        return $this->render('default/contact.html.twig' , array(
         'form' => $form->createView(),
        ));
    }

    public function confirmAction() {
        return $this->render('default/contactconfirm.html.twig');
    }
}
