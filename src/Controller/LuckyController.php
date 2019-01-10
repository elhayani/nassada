<?php

// src/Controller/LuckyController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Etudiants;

class LuckyController extends AbstractController {

    /**
     * @Route("/lucky/number")
     */
    public function number() {

        $number = random_int(0, 100);
        return $this->render('lucky/number.html.twig', [
                    'number' => $number,
        ]);
    }

    /**
     * @Route("/lucky/home")
     */
    public function home() {
        $doct = $this->getDoctrine()->getManager();
        $q = $doct->createQuery("select u from App\Entity\Etudiants u where u.id >= 10 and u.id <= 20");
        $etudiants = $q->getResult();
        //var_export($etudiants);
        return $this->render('lucky/home.html.twig', ['etudiants' => $etudiants]);
    }

    /**
     * @Route("/lucky/news")
     */
    public function news() {

        $doct = $this->getDoctrine()->getManager();

        $etud = new Etudiants();
        $etud->setNom('elha');
        $etud->setPrenom('nass');
        $etud->setDateNaissance(new \DateTime());

        $doct->persist($etud);
        $doct->flush();

        return $this->render('lucky/news.html.twig', []);
    }

    /**
     * @Route("/lucky/contact")
     */
    public function contact() {

        $stud = $this->getDoctrine()
                ->getRepository(Etudiants::class)
                ->findAll();

        return $this->render('lucky/contact.html.twig', ['students' => $stud,]);
    }

    /**
     * @Route("/lucky/about")
     */
    public function about() {
        $doct = $this->getDoctrine()->getManager();
        
        $etud = $this->getDoctrine()
                ->getRepository(Etudiants::class)
                ->find(1);
;
        var_export($etud);


        $doct->remove($etud);
        $doct->flush();

        return $this->render('lucky/about.html.twig', []);
    }

}
