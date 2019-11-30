<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UserType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Utilisateurs;
use App\Repository\UtilisateursRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class BlogController extends AbstractController
{
    private $passwordEncoder;
    
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
        $this->passwordEncoder = $passwordEncoder;
     }
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('blog/home.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(Request $request, ObjectManager $manager, UtilisateursRepository $repo)
    {
        $utilisateur = new Utilisateurs();
        $form = $this->createForm(UserType::class, $utilisateur);
        $form->handleRequest($request);
        $q = null;
        if ($form->isSubmitted() && $form->isValid()) {
            $q = $repo->findOneBy(['email' => $utilisateur->getEmail()]);
            dump('email retrive ', $q);
           // dump($form->getData());
            if($q) {
                dump("l'email existe deja  ");
            } else {
                $pass = $utilisateur->getPassword();
                $utilisateur->setPassword($this->passwordEncoder->encodePassword(
                    $utilisateur,
                    $pass
                ));
                $manager->persist($utilisateur);
                $manager->flush();
               // return $this->redirectToRoute('article');
            }
            
        }
        return $this->render('blog/inscription.html.twig', [
            'formulaire'=> $form->createView(),
            'email_error'=> $q !== null
        ]);
    }
}
