<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Films;
use AppBundle\Entity\User;
use AppBundle\Form\FilmType;
use AppBundle\Form\UserType;
use AppBundle\Manager\UserManager;
use AppBundle\Manager\FilmManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
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
     * @Route("/film/edit/{id}", name="film_edit")
     */
    public function editfilmAction(FilmManager $filmManager, Request $request,  $id)
      {
          $em = $this->getDoctrine()->getManager();
          /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
          $film = $em->getRepository(Films:: class)
              ->find($id);

          $film->setBrochure(null);
          $film->setVideo(null);
          $form = $this->createForm(FilmType:: class, $film);
         // $film->setBrochure(new File($this->getParameter('brochures_directory').'/'.$film->getBrochure()));
          //$film->setVideo(new File($this->getParameter('video_directory').'/'.$film->getVideo()));
          $form->handleRequest($request);
          if ($form->isSubmitted() && $form->isValid())
          {
              $newfilm = $form->getData();
              $filmManager->addFilm($newfilm);
              return $this->redirectToRoute('films');
          }
          return $this->render('media/film-edit.html.twig', [
              'form' => $form->createView(),
          ]);
      }


    /**
     * @Route("/film/delete/{id}", name="film-delete", requirements={"id"="\d+"})
     */
    public function deleteFilmAction(FilmManager $filmManager, $id)
    {
        $filmManager->deleteFilm($id);


        return $this->redirectToRoute('films');


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
     * @Route("/user/edit/{id}", name="user_edit")
     */
    public function editAction(UserManager $userManager, Request $request,  $id)
    {

    $em = $this->getDoctrine()->getManager();
    $user = $em->getRepository(User:: class)
    ->find($id);

    $form = $this->createForm(UserType:: class, $user);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid())
    {
    $user = $form->getData();
    $userManager->createUser($user);
    $em = $this->getDoctrine()->getManager();
    $em->persist($user);
    $em->flush();
    return $this->redirectToRoute('admin_users');
    }

    return $this->render('user/user-edit.html.twig', [ 'form' => $form->createView()
    ]);
    }




    /**
     * @Route("/user/delete/{id}", name="user-delete", requirements={"id"="\d+"})
     */
    public function deleteuserAction(UserManager $userManager, $id)
    {
        $userManager->deleteUser($id);


        return $this->redirectToRoute('admin_users');


    }


}

?>