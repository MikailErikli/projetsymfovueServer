<?php

namespace App\Controller;

use App\Form\UserFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
     * @Route("/account", name="app_account")
     */
    public function index(): Response
    {
        return $this->render('account/show.html.twig');
    }

    /**
     * @Route("/account/edit", name="app_account_edit")
     */

    public function edit(Request $request): Response
    {
        $form = $this->createForm(UserFormType::class);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

        dd('Processing...'); }

        return $this->render('account/edit.html.twig', [
            'Form' => $form->createView()
        ]);

    }
}
