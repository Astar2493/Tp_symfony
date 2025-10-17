<?php
namespace App\Controller;
use phpDocumentor\Reflection\DocBlock\Tags\Extends_;
use phpDocumentor\Reflection\DocBlock\Tags\Template;
use phpDocumentor\Reflection\Types\AbstractList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController{
    #[Route('/', name: 'home')]
    public function renderHome(){
        return $this ->render('home.html.twig');
    }
}
