<?php

namespace App\Controller;

use App\Entity\House;
use App\Repository\HouseRepository;
use App\Form\HouseType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(HouseRepository $houseRepository)
    {
        $houses = $houseRepository->findAll();
        return $this->render('main/index.html.twig', [
            'houses' => $houses
        ]);
    }

    /**
     * @Route("/house/add", name="house_add")
     */
    public function add(Request $request)
    {
        $house = new House();
        $form = $this->createForm(HouseType::class, $house);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $house->setCreatedAt(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($house);
            $em->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('houses/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/house/{id}/edit", name="house_edit")
     */
    public function edit(House $house, Request $request)
    {
        $form = $this->createForm(HouseType::class, $house);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('house_show', [
                'id' => $house->getId()
            ]);
        }

        return $this->render('houses/new.html.twig', [
            'form' => $form->createView()
        ]);
    }



}
