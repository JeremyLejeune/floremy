<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Films;
use AppBundle\Entity\User;
use AppBundle\Manager\UserManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function categoryAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('admin/admin.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }



    /**
     * @Route("/admin_films", name="admin_films")
     */
    public function listMovies()
    {
        $em = $this->getDoctrine()->getManager();
        $films = $em->getRepository(Films::class)->findAll();
        return $this->render('admin/films_admin.html.twig',[
            'films' => $films
        ]);
    }



    /**
     * @Route("/admin_users", name="admin_users")
     */
    public function listAction(UserManager $userManager)
    {
        $user = $userManager->getUsers();

        return $this->render('admin/profiles.html.twig', [
            'user' => $user
        ]);
    }



    /**
     * @Route("/user/delete/{id}", name="user-delete", requirements={"id"="\d+"})
     */
    public function deleteAction(UserManager $userManager, $id)
    {
        $userManager->deleteUser($id);


        return $this->redirectToRoute('admin_users');


    }


}

?>