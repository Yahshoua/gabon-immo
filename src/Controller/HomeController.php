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
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\JsonResponse;
class HomeController extends AbstractController
{

    /**
     * @Route("/home", name="home")
     */
    public function index(AppartementRepository $appart, PhotosRepository $photos, Request $request, ObjectManager $manager)
    {
        $all = $appart->findBy([], ['id'=>'DESC'], 6);
        $elm = $appart->find(1);
        $sendbox = new GetTouche();
        $formContact = $this->createForm(GetTouchType::class, $sendbox);
        $formContact->handleRequest($request);
        if($formContact->isSubmitted()) {
            $sendbox->setCreatedAt(new \DateTime());
            $manager->persist($sendbox);
            $manager->flush();
            return new JsonResponse(['form'=> $formContact->getData()], 201);
        }
        if($request->request->count() >0) {
            $type = $request->request->get('type');
            $category = $request->request->get('category');
            $key = $request->request->get('key');
            return $this->redirectToRoute('recherche', ['type' => $type, 'category'=>$category, 'key'=>$key]);
        }
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
            'houses'=> $locationTypes[0],
            'type'=> $type
        ]);
    }
    /**
     * @Route("/recherche/{type}/{category}/{key}", name="recherche")
     */
    public function search($type, $category, $key, AppartementRepository $appart) {
        switch ($type) {
            case 'vente':
                $types = 2;
                break;
            case 'location':
                $types = 1;
                break;
            }
            switch ($category) {
                case 'Appartement':
                    $cat = 11;
                    break;
                case 'Studio':
                    $cat = 4;
                    break;
                case 'Duplex':
                        $cat = 12;
                    break;
                case 'Chambre':
                        $cat = 13;
                    break;
                case 'Bureau':
                        $cat = 10;
                    break;
                case 'Chambre américaine':
                        $cat = 9;
                    break;
                case 'Fond de commerce':
                        $cat = 2;
                    break;
                case 'Immeuble':
                        $cat = 7;
                    break;
                case 'Local commercial':
                        $cat = 6;
                    break;
                case 'Maison':
                        $cat = 5;
                    break;
                case 'Villa':
                        $cat = 3;
                    break;
                case 'Terrain':
                        $cat = 1;
                    break;
                }
                dump(intval($types));
                dump(intval($cat));
        $search = $appart->findByWord(intval($types), intval($cat), $key);
        dump($search);
        return $this->render('home/recherche.html.twig',[
            'houses'=> $search,
            'type'=> $type
        ]);
    }
}
