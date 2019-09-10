<?php

namespace App\Controller;

use App\Entity\House;
use App\Entity\Quarters;
use App\Form\QuartersType;
use App\Repository\HouseRepository;
use App\Form\HouseType;
use App\Repository\QuartersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Component\Pager\Paginator;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request, PaginatorInterface $paginator, HouseRepository $houseRepository)
    {
        $allAppointmentsQuery = $houseRepository->createQueryBuilder('p')
            ->getQuery();
        $houses = $paginator->paginate(
            $allAppointmentsQuery,
            $request->query->getInt('page', 1),
            6
        );
        //$houses = $houseRepository->findAll();
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
            'form' => $form->createView(),
            'button' => 'Add'
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
            'form' => $form->createView(),
            'button' => 'Update'
        ]);
    }

    /**
     * @Route("/house/{id}/delete", name="house_delete")
     */
    public function delete(House $house)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($house);
        $em->flush();

        return $this->redirectToRoute('index');
    }

    /**
     * @Route("/house/{id}/add_quarters", name="house_add_quarters")
     */
    public function addQuarters(House $house, Request $request)
    {
        $quarters = new Quarters();
        $form = $this->createForm(QuartersType::class, $quarters);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $quarters->setCreatedAt(new \DateTime());
            $quarters->setHouse($house);


            $em = $this->getDoctrine()->getManager();
            $em->persist($quarters);
            $em->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('quarters/new.html.twig', [
            'form' => $form->createView(),
            'house' => $house,
            'button' => 'Add'
        ]);
    }

    /**
     * @Route("/house/{id}", name="house_show")
     */
    public function house(Request $request, House $house, PaginatorInterface $paginator, QuartersRepository $quartersRepository)
    {

        $id = $house->getId();
        $allAppointmentsQuery = $quartersRepository->createQueryBuilder('q')
            ->andWhere("q.house = $id")
            ->getQuery();
        $quarters = $paginator->paginate(
            $allAppointmentsQuery,
            $request->query->getInt('page', 1),
            3
        );

        //$quarters = $house->getQuarters();
        return $this->render('houses/show.html.twig', [
            'house' => $house,
            'quarters' => $quarters
        ]);
    }

}