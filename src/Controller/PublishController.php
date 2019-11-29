<?php

namespace App\Controller;

use App\Entity\Appartement;
use App\Form\AppartementType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
class PublishController extends AbstractController
{
    /**
     * @Route("/publier", name="publish")
     * @param Request $request
     * @return JsonResponse|FormInterface
     */
    public function index(Request $request, ObjectManager $manager)
    {
        $appart = new Appartement();
        $tag = [];
        $form = $this->createForm(AppartementType::class, $appart, ['action'=> $this->generateUrl('publish')]);
        $form->handleRequest($request);

                if ($request->isXMLHttpRequest()) {
                    $tag = $request->get('tag');
                    $response = new Response();
                    $response->setContent(json_encode([
                    'tag'=> 'ok'
                    ]));
                    $response->headers->set('Content-Type', 'application/json');
                    $appart->setCaracteristiques($tag);
                    return $response;
                }
        if ($form->isSubmitted()) {
            $appart->setPrix(intval($request->get('montant')))
                    ->setCreatedAt(new \DateTime());
            $brr = $form->getData()->getTags();        
            $appart->setCaracteristiques(explode(',', $brr));
            $manager->persist($appart);
            $manager->flush();
             return new JsonResponse([$appart->getCaracteristiques()], 201);
        }
        return $this->render('publish/index.html.twig', [
            'controller_name' => 'PublishController',
            'form'=> $form->createView()
        ]);
    }
}
