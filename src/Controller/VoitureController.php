<?php

namespace App\Controller;

use App\Entity\SearchCar;
use App\Form\SearchCarType;
use App\Repository\CarRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoitureController extends AbstractController
{

    /**
     * @Route("/profile/voitures", name="voitures")
     */
    public function voitures(CarRepository $carRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $searchCar = new SearchCar();

        $form = $this->createForm(SearchCarType::class, $searchCar);
        $form->handleRequest($request);

        $cars = $paginator->paginate(
            $carRepository->findAllWithPaginator($searchCar), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            3 /*limit per page*/
        );




        return $this->render('voiture/voitures.html.twig', [
            "cars" => $cars,
            "form" => $form->createView(),
            "admin" => false
        ]);
    }
}
