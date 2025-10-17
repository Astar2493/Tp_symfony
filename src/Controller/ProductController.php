<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    #[Route('/products', name: 'list_products')]
    public function renderListProductsPage(ProductRepository $productRepository){
        $products = $productRepository->findAll();

        return $this->render('products.html.twig', [
            'products' => $products
        ]);

    }

    #[Route('/products/{id}', name: 'single_product')]
    public function renderSingleProductPage(ProductRepository $productRepository, $id){
        $product = $productRepository->find($id);

        return $this->render('SingleProduct.html.twig', [
            'product' => $product
        ]);
    }

    #[Route('/CreateProduct', name: 'create_product')]
    public function renderCreateProduct(Request $request, EntityManagerInterface $entityManager){
        $title = null;

        if ($request->isMethod('POST')) {
            $title = $request->request->get('title');
            $description = $request->request->get('description');
            $price = $request->request->get('price');
            $price_promo = $request->request->get('price_promo');
            $link_img = $request->request->get('link_img');

            $product = new Product();
            $product->setTitle($title);
            $product->setDescription($description);
            $product->setPrice($price);
            $product->setPricePromo($price_promo !== '' ? (float)$price_promo : null);
            $product->setLinkImg($link_img);

            $entityManager->persist($product);
            $entityManager->flush();



        }
        return $this->render('CreateProduct.html.twig', [
            'title' => $title,
        ]);
    }

    #[Route('/products/delete/{id}', name: 'delete_product')]
    public function renderDeleteProduct($id, ProductRepository $productRepository, EntityManagerInterface $entityManager){
        $product = $productRepository->find($id);

        $entityManager->remove($product);
        $entityManager->flush();

        return $this->redirectToRoute('list_products');
    }

    #[Route('products/update/{id}', name: 'update_product')]
    public function renderUpdateProduct($id, ProductRepository $productRepository, Request $request, EntityManagerInterface $entityManager){
        $product = $productRepository->find($id);

        if ($request->isMethod('POST')) {
            $title = $request->request->get('title');
            $description = $request->request->get('description');
            $price = $request->request->get('price');
            $price_promo = $request->request->get('price_promo');
            $link_img = $request->request->get('link_img');

            $product->setTitle($title);
            $product->setDescription($description);
            $product->setPrice($price);
            $product->setPricePromo($price_promo !== '' ? (float)$price_promo : null);
            $product->setLinkImg($link_img);

            $entityManager->persist($product);
            $entityManager->flush();
        }

        return $this->render('UpdateProduct.html.twig', [
            'product' => $product
        ]);
    }

}
