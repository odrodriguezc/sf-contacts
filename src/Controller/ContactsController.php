<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
        $user = $this->getUser();

        return $this->render('contacts/index.html.twig', [
            //filtering user by owner (user)
            'contacts' => $contactEntityRepository->findBy(['user' => $user]),
        ]);
    }

    /**
     * @Route("/contact/{id<\d+>}", name="contact_show")
     */
    public function show(Contact $contact)
    {

        return $this->render('contacts/show.html.twig', [
            'contact' => $contact
        ]);
    }

    /**
     * @Route("/contact/create", name="contact_create")
     */
    public function create(Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User */
            $contact = $form->getData();

            $em->persist($contact);
            $em->flush();

            return $this->redirectToRoute('contact_show', [
                'id' => $contact->getId()
            ]);
        }

        return $this->render('contacts/create.html.twig', [
            'formContact' => $form->createView()
        ]);
    }

    /**
     * @Route("/contact/{id<\d+>}/edit", name="contact_edit")
     */
    public function edit(Contact $contact, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->flush();

            return $this->redirectToRoute('contact_show', [
                'id' => $contact->getId()
            ]);
        }

        return $this->render('contacts/edit.html.twig', [
            'formContact' => $form->createView()
        ]);
    }

    /**
     * @Route("/contact/{id<\d+>}/delete", name="contact_delete")
     */
    public function delete(Contact $contact, EntityManagerInterface $em)
    {
        $em->remove($contact);
        $em->flush();

        return $this->redirectToRoute('contacts_index');
    }
}
