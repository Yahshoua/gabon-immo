<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Commentaires;
use App\Form\FormCommentType;
use App\Form\ReservationType;
use App\Repository\PhotosRepository;
use App\Repository\AppartementRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HouseController extends AbstractController
{
    private $appart;
    private $photos;
    public function __construct(AppartementRepository $appart, PhotosRepository $photos) {
        $this->appart = $appart;
        $this->photos = $photos;
    }
     /**
     * @Route("/immo_point/{title}-{id}", name="immo", requirements={"title": "[a-z0-9\-]*"})
     * @return Response
     */
    public function index($title, $id, Request $request, ObjectManager $manager, AppartementRepository $appartement)
    {
        // Publier 1 commentaire
        $comment = new Commentaires();
        $find= $this->appart->find($id);
        
        $form = $this->createForm(FormCommentType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setCreatedAt(new \DateTime())
                    ->setAppartement($find);
            $manager->persist($comment);
            $manager->flush();
            $comments = $find->getComments()->last();
            dump($comments);
            return $this->render('immo/commentaires.html.twig',[
                'commentaires'=> $comments
            ]);
        }
        // Publier une reservation
        $reservation = new Reservation();
        $form2 = $this->createForm(ReservationType::class, $reservation);
        $form2->handleRequest($request);
        // fin
        //Find By categorie
       $IDAp =  $find->getCategory()->getId();
       $e = $appartement->findByAnnexes($IDAp, $id);
       dump($e);
        return $this->render('immo/index.html.twig', [
            'houses'=> $find,
            'form'=>  $form->createView(),
            'form2'=> $form2->createView(),
             'annexes'=> $e,
             'count'=> $find->getComments()->count()
        ]);
    }
}
