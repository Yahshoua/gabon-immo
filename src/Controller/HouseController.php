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
use App\Entity\Types;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
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
            // dump($comments);
            return $this->render('immo/commentaires.html.twig',[
                'commentaires'=> $comments
            ]);
        }
        // recherche avancée (travail incomplet sorry :( ))
            if($request->request->count() >0) {
              //  $req = $request->request();
              $cat = intval($request->request->get('form')['Category']);
              $bednumber = intval($request->request->get("bednumber"));
              $bathnumber = intval($request->request->get("bathnumber"));
              $mettremin = intval($request->request->get("mettremin"));
              $mettremax = intval($request->request->get("mettremax"));
              $budgetmin = intval($request->request->get("budgetmin"));
              $budgetmax = intval($request->request->get("budgetmax"));
              $ville = intval($request->request->get("locale"));
              $type = [];
                if(isset($request->request->get('form')['Types'])) {
                    $type1 = $request->request->get('form')['Types'][0];
                    for($i=0;$i<count($request->request->get('form')['Types']);$i++) {
                        $type[] = $request->request->get('form')['Types'][$i];
                    }
                }
                dump($type);
              $res = $appartement->findBySearch($cat,$ville, $bednumber, $bathnumber, $mettremin,$mettremax, $budgetmin, $budgetmax, $type);
             // dump($request->request);
             // dump($res);
              return $this->redirectToRoute('rechercheplus');
            }
        //fin
        // Publier une reservation
        $reservation = new Reservation();
        $form2 = $this->createForm(ReservationType::class, $reservation);
        $form2->handleRequest($request);
        // fin
        //Recherche avancée
        $forms = $this->createFormBuilder()
                ->add('Types', EntityType::class, [
                    'label'=> 'Quel type ?',
                    'class'=> Types::class,
                    'choice_label'=> 'types',
                    'multiple'=> true,
                    'attr'=> [
                        'placeholder'=> 'exemple: je vends',
                        'class'=> 'input types'
                    ]
                ])
                ->add('Category', EntityType::class, [
                    'label'=> 'Que cherchez-vous ?',
                    'class'=> Category::class,
                    'choice_label'=> 'label',
                    'attr'=> [
                        'class'=> 'input'
                    ]
                ])
                ->getForm();

        // fin
        // Trouver les categorie
        $arraycat = [
            ['name'=> 'terrain', 'count'=> count($appartement->findBy(['category'=> 1]))],
            ['name'=>'fond de commerce', 'count'=> count($appartement->findBy(['category'=> 2]))],
            ['name'=>'villa','count'=> count($appartement->findBy(['category'=> 3]))],
            ['name'=>'Studio', 'count'=> count($appartement->findBy(['category'=> 4]))],
            ['name'=>'Maison', 'count'=> count($appartement->findBy(['category'=> 5]))],
            ['name'=>'local commercial', 'count'=> count($appartement->findBy(['category'=> 6]))]
        ];
        $autre = intval(count($appartement->findBy(['category'=> 7])) + count($appartement->findBy(['category'=> 8]))+count($appartement->findBy(['category'=> 9]))+ count($appartement->findBy(['category'=> 10]))+count($appartement->findBy(['category'=> 11]))+count($appartement->findBy(['category'=> 12]))+count($appartement->findBy(['category'=> 13])));
        //fin
        //Find By categorie
       $IDAp =  $find->getCategory()->getId();
       $e = $appartement->findByAnnexes($IDAp, $id);
        return $this->render('immo/index.html.twig', [
            'houses'=> $find,
            'form'=>  $form->createView(),
            'form2'=> $forms->createView(),
             'annexes'=> $e,
             'count'=> $find->getComments()->count(),
             'arraycat'=> $arraycat,
             'autre'=> $autre,
             'title'=> $title,
             'id'=> $id
        ]);
    }
}
