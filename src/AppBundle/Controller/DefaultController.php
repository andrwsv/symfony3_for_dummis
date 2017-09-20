<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\post;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        /*return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);*/
        /*return $this->render('layout/base.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);*/
        $PostController = new PostController();
        $posts = $PostController->getPost($this);
        return $this->render('AppBundle:Home:index.html.twig', 
            array(
                    'posts'=>$posts,
                )
            );
    }


    /**
     * @Route("/post/{id}", name="simple_post")
     */
    public function simple_post($id)
    {
        $PostController = new PostController();
        $posts = $PostController->getInfoPost($this, $id);
        return $this->render('AppBundle:Post:simple.html.twig',array('id'=>$id, 'post'=>$posts));
    }

}
