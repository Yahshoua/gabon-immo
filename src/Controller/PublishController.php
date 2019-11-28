<?php

namespace App\Controller;

use App\Entity\Appartement;
use App\Form\AppartementType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PublishController extends AbstractController
{
    /**
     * @Route("/publier", name="publish")
     */
    public function index(Request $request, ObjectManager $manager)
    {
        $appart = new Appartement();
        $tag = [];
        $form = $this->createForm(AppartementType::class, $appart);
        $form->handleRequest($request);
        if ($request->isXMLHttpRequest()) {
            $tag = $request->get('tag');
            $response = new Response();
            $response->setContent(json_encode([
                'tag'=> $tag
            ]));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
        if ($form->isSubmitted()) {
            $appart->setPrix(intval($request->get('montant')))
                    ->setCreatedAt(new \DateTime());
            $appart->setCaracteristiques($tag);
            var_dump($appart->getCaracteristiques());
           // dump($form->getData());
            $manager->persist($appart);
           // $manager->flush();
        }
        return $this->render('publish/index.html.twig', [
            'controller_name' => 'PublishController',
            'form'=> $form->createView()
        ]);
    }
}
