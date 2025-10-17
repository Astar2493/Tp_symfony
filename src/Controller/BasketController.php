<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BasketController extends AbstractController
{
    #[Route('/basket', name: 'basket')]
    public function basket(Request $request, ProductRepository $productRepository){
        $confirmation = null;
        $products = $productRepository->findAll();

        if ($request->isMethod('POST')){
            $email = $request->request->get('email');
            if (strlen($email) < 5){
                $confirmation = "L'adresse email est trop courte";
            }else{
                $confirmation = "votre panier est validé";
            }
        }
        return $this->render('basket.html.twig', [
            'confirmation' => $confirmation,
            'products' => $products
        ]);
    }
}
