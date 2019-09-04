<?php

namespace App\Controller;

use App\Repository\HouseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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



}
