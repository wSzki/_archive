<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class FabriqueController
{
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(Environment $twig){
        $this->twig = $twig;
    }
    /**
     * @Route("/fabriques", name="all_fabriques")
     */
    public function index()
    {
        return new Response(
            $this->twig->render('pages/fabriques.html.twig')
        );
    }
}