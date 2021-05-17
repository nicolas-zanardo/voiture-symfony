<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use App\Entity\SearchCar;
use App\Form\CarType;
use App\Form\SearchCarType;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(CarRepository $carRepository, PaginatorInterface $paginator, Request $request): Response
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
            "admin" => true
        ]);
    }

    /**
     * @Route("/admin/creation", name="add")
     * @Route("/admin/{id}", name="editCar", methods="GET|POST")
     */
    public function edit(Car $car = null, Request $request, EntityManagerInterface $entityManagerInterface)
    {
        if (!$car) {
            $car = new car();
        }

        $form = $this->createForm(CarType::class, $car);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $modif =  $car->getId() !== null;
            $entityManagerInterface->persist($car);
            $entityManagerInterface->flush();
            $this->addFlash("success", ($modif) ? "La modification a été effectué: " . $car->getImmatriculation() : "L'ajout a été effectué: " . $car->getImmatriculation());
            return $this->redirectToRoute("admin");
        }

        return $this->render('admin/edit.html.twig', [
            "car" => $car,
            "form" => $form->createView(),
            "isModification" => $car->getId() !== null
        ]);
    }

    /**
     * @Route("/admin/delete/{id}", name="delete", methods="delete")
     */
    public function delete(Car $car, Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        if ($this->isCsrfTokenValid("SUP" . $car->getId(), $request->get('_token'))) {
            $entityManagerInterface->remove($car);
            $entityManagerInterface->flush();
            $this->addFlash('success', "La supression a été effectué: " . $car->getImmatriculation());
            return $this->redirectToRoute("admin");
        }
    }
}
