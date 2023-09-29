<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    
    private $authors = array(
        array('id' => 1, 'picture' => '/images/Victor_Hugo.jpg', 'username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com', 'nb_books' => 100),
        array('id' => 2, 'picture' => '/images/william-shakespeare.jpg', 'username' => 'William Shakespeare', 'email' => 'william.shakespeare@gmail.com', 'nb_books' => 200),
        array('id' => 3, 'picture' => '/images/Taha_Hussein.jpg', 'username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300),
    );

    #[Route('/showAuthor/{name}', name: 'app_showAuthor')]
    public function showAuthor($name)
    {
        return $this->render('Author/show.html.twig', ['name' => $name]);
    }

    #[Route('/showlistAuthor', name: 'app_showlistAuthor')]
    public function list()
    {
        $title = "Authors";

       
        return $this->render('Author/list.html.twig', ['t' => $title, 'A' => $this->authors]);
    }

    #[Route('/AuthorDetails/{id}', name: 'app_detailsAuthor')]
    public function AuthorDetails($id)
    {
       
        $selectedAuthor = null;
        foreach ($this->authors as $author) {
            if ($author['id'] == $id) {
                $selectedAuthor = $author;
                break;
            }
        }

       
        if (!$selectedAuthor) {
            throw $this->createNotFoundException('Author not found');
        }

        return $this->render('Author/ShowAuthor.html.twig', ['author' => $selectedAuthor]);
    }
}