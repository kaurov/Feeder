<?php

namespace App\Controller;

use App\Entity\Blog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getRepository(Blog::class);
        if (isset($_REQUEST['s'])) {
            $blogRecords = $em->createQueryBuilder('b')
                ->where('b.title LIKE :search')
                ->orWhere('b.content LIKE :search')
                ->setParameter('search', '%' . $_REQUEST['s'] . '%')
                ->getQuery()
                ->getResult();
        } else {
            $blogRecords = $em->findAll();
        }
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'blogRecords' => $blogRecords,
        ]);
    }
}