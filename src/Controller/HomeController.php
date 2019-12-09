<?php

namespace App\Controller;
use App\Entity\GetTouche;
use App\Form\GetTouchType;
use App\Form\ReservationType;
use App\Repository\PhotosRepository;
use App\Repository\AppartementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;
use App\Entity\Appartement;
use App\Entity\Types;
use App\Repository\TypesRepository;
use Cocur\Slugify\Slugify;
use Twig\Extensions\TextExtension;
class HomeController extends AbstractController
{

    /**
     * @Route("/home", name="home")
     */
    public function index(AppartementRepository $appart, PhotosRepository $photos, Request $request)
    {
        $all = $appart->findBy([], ['id'=>'DESC'], 6);
        $elm = $appart->find(1);
        $formContact = $this->createForm(GetTouchType::class);
        $formContact->handleRequest($request);
        
        dump($all);
        // $p=$elm->getTypes()->toArray();
        // dump($elm->getTypes()->toArray()[0]->getTypes());
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'houses'=>$all,
            'contactForm'=> $formContact->createView()
        ]);
    }
    /**
     * @Route("/type de bien/{type}", name="location")
     */
    public function allow($type, TypesRepository $types, AppartementRepository $appart) {
        $locationTypes = $types->findBy(['types'=> $type]);
        dump($locationTypes[0]);
        return $this->render('home/location.html.twig',[
            'houses'=> $locationTypes[0]
        ]);
    }
}
