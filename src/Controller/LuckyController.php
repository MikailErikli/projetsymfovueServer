<?php

namespace App\Controller;
use App\Entity\Pin;
use App\Form\PinType;
use App\Repository\PinRepository;
use App\Repository\UserRepository;
use Doctrine\DBAL\Types\TextType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class LuckyController extends AbstractController
{


    /**
     * @Route("/", name="app_home",methods={"GET"})
     */


    public function index(PinRepository $repo): Response
    {

        return $this->render('pins/index.html.twig', ['pins' => $repo->findAll()]);
    }


    /**
     * @Route("/pins/create",name="app_pins_create",methods={"GET","POST"})
     */


    public function create(Request $request, EntityManagerInterface $em, UserRepository $userRepo): Response
    {

        $pin = new Pin;
        $form = $this->createForm(PinType::class, $pin);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pin->setUser($this->getUser());
            $em->persist($pin);
            $em->flush();

        $this->addFlash('success','Pin successfully created');
            return $this->redirectToRoute('app_pins_show', ['id' => $pin->getId()]);
        }
        return $this->render('pins/create.html.twig', ['Form' => $form->createView()]);

    }

    /**
     * @Route("/pins/{id<[0-9]+>}", name="app_pins_show")
     */
    public function show(Pin $pin): Response
    {
        return $this->render('pins/show.html.twig', compact('pin'));
    }


    /**
     * @Route("/pins/{id<[0-9]+>}/edit", name="app_pins_edit")
     */
    public function edit(Request $request, Pin $pin, EntityManagerInterface $em): Response
    {

        $form = $this->createForm(PinType::class, $pin);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            $this->addFlash('success','Pin successfully Edited');

            return $this->redirectToRoute('app_home');

        }
        return $this->render('pins/edit.html.twig', [
            'pin' => $pin,
            'Form' => $form->createView()

        ]);

    }


    /**
     * @Route("/pins/{id<[0-9]+>}/delete", name="app_pins_delete")
     */
    public function delete(Request $request, Pin $pin, EntityManagerInterface $em): Response
    {

            $em->remove($pin);
            $em->flush();;

        $this->addFlash('info','Pin successfully deleted');

            return $this->redirectToRoute('app_home');


    }
}
