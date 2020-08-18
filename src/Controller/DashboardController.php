<?php

namespace App\Controller;

use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard_index")
     */
    public function index()
    {
        return $this->render('dashboard/index.html.twig', [
            'user' => $this->getUser(),
        ]);
    }

    /**
     * @Route("/dashboard/quick-search-name/{query}", name="dashboard_quick_search_by_name")
     */
    public function quickSearchByName(ContactRepository $contactRepository, $query)
    {
        $data = $contactRepository->findByFullName($query);

        return $this->json($data, 200);
    }

    /**
     * @Route("/dashboard/quick-search-number/{query}", name="dashboard_quick_search_by_number")
     */
    public function quickSearchByNumber(ContactRepository $contactRepository, $query)
    {
        $data = $contactRepository->findByNumber($query);

        return $this->json($data, 200);
    }
}
