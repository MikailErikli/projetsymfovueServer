<?php

namespace App\Controller;


use App\Entity\Pin;
use App\Entity\User;
use App\Repository\PinRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * @Route("/api", name="api_")
 */

class APIController extends AbstractController
{
    /**
     * @Route("/pins/liste", name="liste", methods={"GET"})
     */
    public function liste(PinRepository $pinrep): Response
    {
       $pins = $pinrep->apiFindAll();

       // On spécifie qu'on utilise un encodeur en json
        $encoders =[new JsonEncoder()];

        // On instancie le "normaliseur" pour convertir la collection en tableau
        $normalizers = [new ObjectNormalizer()];

        // On fait la conversion en Json
        // On instancie le convertisseur
        $serializer = new Serializer($normalizers , $encoders);

        // On convertie en Json
        $jsonContent = $serializer->serialize($pins , 'json', [
            'circular_reference_handler' => function($object){
            return $object->getId();
            }
        ]);
       // On instancie la réponse de symfony
        $response = new Response($jsonContent);

        // On ajoute l'entête HTTP
        $response->headers->set('Content-Type','application/json');

        // On envoie la réponse
        return $response;
    }



    /**
     * @Route("/pins/voir/{id}", name="voir", methods={"GET"})
     */
    public function getpin(Pin $pin): Response
    {

        // On spécifie qu'on utilise un encodeur en json
        $encoders =[new JsonEncoder()];

        // On instancie le "normaliseur" pour convertir la collection en tableau
        $normalizers = [new ObjectNormalizer()];

        // On fait la conversion en Json
        // On instancie le convertisseur
        $serializer = new Serializer($normalizers , $encoders);

        // On convertie en Json
        $jsonContent = $serializer->serialize($pin , 'json', [
            'circular_reference_handler' => function($object){
                return $object->getId();
            }
        ]);
        // On instancie la réponse de symfony
        $response = new Response($jsonContent);

        // On ajoute l'entête HTTP
        $response->headers->set('Content-Type','application/json');

        // On envoie la réponse
        return $response;
    }


    /**
     * @Route("/pins/ajout", name="ajout", methods={"POST"})
     */
    public function addPin(Request $request): Response
    {
        // On vérifie si on a une requête XMLHttpRequest
        if($request->isXmlHttpRequest()){
            // on vérifie les donnée après les avoirs decoder
            $donnees = json_decode($request->getContent());
            // on instancie un nouvelle article
            $pin = new Pin();
            // On hydrate notre article
            $pin->setTitle($donnees->title);
            $pin->setDescription($donnees->decription);


            //ON sauvegarde en base de données*
            $em = $this->getDoctrine()->getManager();
            $em->persist($pin);
            $em->flush();

            return new Response('Ok', 201);
        }
        return new Response('Erreur', 404);

    }

}
