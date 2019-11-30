<?php

namespace App\Controller;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Form\ArticleFormType;
class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function index(ArticleRepository $repo)
    {
        $articles = $repo->findAll();
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'article'=> $articles
        ]);
    }
     /**
     * @Route("/article/{index}-{title}", name="lire")
     */
    public function suite (Article $article)
    {
        return $this->render('article/lire.html.twig', [
            'controller_name' => 'ArticleController',
            'article'=> $article
        ]);
    }
    /**
     * @Route("/article/{index}-{title}/edit", name="edit")
     */
     public function Edit (Article $article = null)
    {
        $article = new Article();
        $form = $this->createForm(ArticleFormType::class, $article);
        return $this->render('article/edit.html.twig', [
            'controller_name' => 'ArticleController',
            'formulaire'=> $form->createView()
        ]);
    }
}
