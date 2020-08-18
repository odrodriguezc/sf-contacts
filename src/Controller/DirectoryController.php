<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\ContactRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin")
 */
class DirectoryController extends AbstractController
{
    /**
     * @Route("/directory", name="directory_index")
     * @todo change dql to exclure the own directory
     */
    public function index(UserRepository $userRepository)
    {
        return $this->render('directory/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/directory/{id<\d+>}", name="directory_show")
     */
    public function show(User $user, ContactRepository $contactRepository)
    {

        return $this->render('directory/show.html.twig', [
            'user' => $user,
            'contacts' => $contactRepository->findBy(['user' => $user])
        ]);
    }

    /**
     * @Route("/directory/create", name="directory_create")
     * @todo Eneable private / public choice for directories. Temporary auto set in privatemode
     */
    public function create(Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(UserType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User */
            $user = $form->getData();

            //set de directory in private
            $user->setVisibility(false);

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('directory_show', [
                'id' => $user->getId()
            ]);
        }

        return $this->render('directory/create.html.twig', [
            'formDirectory' => $form->createView()
        ]);
    }

    /**
     * @Route("/directory/{id<\d+>}/edit", name="directory_edit")
     * 
     */
    public function edit(User $user, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->flush();

            return $this->redirectToRoute('directory_show', [
                'id' => $user->getId()
            ]);
        }

        return $this->render('directory/edit.html.twig', [
            'formDirectory' => $form->createView()
        ]);
    }

    /**
     * @Route("/directory/{id<\d+>}/delete", name="directory_delete")
     * @todo make form to delete directory
     */
    public function delete(User $user, EntityManagerInterface $em)
    {
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('directory_index');
    }
}
