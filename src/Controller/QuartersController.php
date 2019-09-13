<?php

namespace App\Controller;

use App\Entity\Quarters;
use App\Form\QuartersType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class QuartersController extends AbstractController
{
    /**
     * @Route("/quarters/{id}/edit", name="quarters_edit")
     */
    public function edit(Quarters $quarters, Request $request)
    {
        $form = $this->createForm(QuartersType::class, $quarters);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'info',
                'Quarters added successfully!'
            );

            return $this->redirectToRoute('house_show', [
                'id' => $quarters->getHouse()->getId()
            ]);
        }

        return $this->render('quarters/new.html.twig', [
            'form' => $form->createView(),
            'button' => 'Edit'
        ]);

    }

    /**
     * @Route("/quarters/{id}/delete", name="quarters_delete")
     */
    public function delete(Request $request, Quarters $quarters)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($quarters);
        $em->flush();

        $this->addFlash(
            'info',
            'Quarters deleted successfully!'
        );

        return $this->redirect($request->headers->get('referer'));
    }
}

