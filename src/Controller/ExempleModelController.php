<?php

namespace App\Controller;

use App\Entity\Livre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExempleModelController extends AbstractController
{
    /**
     * @Route("/exemple/model/find/one/by", name="exemple_model")
     */
    public function exempleFindOneBy()
    {
        $em = $this->getDoctrine()->getManager();
        //raccourci de /App/Entity/Livre
        $rep = $em->getRepository(Livre::class);
        //dump and die
        //dd($rep);

        //faire une requête qu'on stock ds une variable
        $livre = $rep->findOneBy(['titre' => 'stupeur et tremblement']);

        //on veut envoyer à la vue

        return $this->render(
            'exemple_model/exemple_find_one_by.html.twig',
            ['livre' => $livre]
        );
    }

    /**
     * @Route("/exemple/model/find/by")
     */
    public function exempleFindBy()
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Livre::class);

        $livres = $rep->findBy(['prix' => '14.00']);

        return $this->render(
            'exemple_model/exemple_find_by.html.twig',
            ['livres' => $livres]
        );
    }

    /**
     * @Route ("/exemple/model/insert")
     */
    public function insererLivre()
    {
        $em = $this->getDoctrine()->getManager();
        // créer l'objet
        $livre1 = new Livre();
        $livre1->setTitre("Les Bienveillantes");
        $livre1->setDescription("Avec cette somme qui s'inscrit aussi bien sous l'égide d'Eschyle que dans la lignée de Vie et destin de Vassili Grossman ou des Damnés de Visconti, Jonathan Littell nous fait revivre les horreurs de la Seconde Guerre mondiale du côté des bourreaux, tout en nous montrant un homme comme rarement on l'avait fait : l'épopée d'un être emporté dans la traversée de lui-même et de l'Histoire.");


        // lier l'objet avec la BD, pas besoin car obtenu de la BD
        $em->persist($livre1);
        // écrire l'objet dans la BD
        $em->flush();

        return new Response("Le livre a bien été inséré");

        // return $this->render("exemple_modele/exemple_insert.html.twig");
    }
}
