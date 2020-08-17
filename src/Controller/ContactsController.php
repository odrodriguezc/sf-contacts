<?php

namespace App\Controller;

use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class ContactsController extends AbstractController
{
    /**
     * @Route("/contacts", name="contacts_index")
     */
    public function index(ContactRepository $contactEntityRepository)
    {
        return $this->render('contacts/index.html.twig', [
            'contacts' => $contactEntityRepository->findAll(),
        ]);
    }
}
