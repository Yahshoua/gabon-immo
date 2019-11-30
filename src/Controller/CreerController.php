<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Form\ArticleFormType;
use Doctrine\Common\Persistence\ObjectManager;
class CreerController extends AbstractController
{
    /**
     * @Route("/creer", name="creer")
     */
    public function index(Request $request, ObjectManager $manager)
    {
        $article = new Article();
        $form = $this->createForm(ArticleFormType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $article->setCreatedAt(new \DateTime());
            dump($form->getData());
            $manager->persist($article);
            $manager->flush();
           return $this->redirectToRoute('article');
        }
        return $this->render('creer/index.html.twig', [
            'formulaire'=> $form->createView()
        ]);
    }
}
