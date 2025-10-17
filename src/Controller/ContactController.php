<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function contact(Request $request){
        $confirmation = null;

        if($request->isMethod('POST')){
            $email = $request->request->get('email');

            if (strlen($email) < 5){
                $confirmation = "L'adresse email est trop courte";
            }else{
                $confirmation = "notre équipe a bien reçu le message, elle reviendra vers vous";
            }

        }
        return $this->render('contact.html.twig', [
            'confirmation' => $confirmation,
        ]);
    }
}
