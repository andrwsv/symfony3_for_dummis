<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Post;

class PostController extends Controller
{

	/**
     * @Route("/insert/post", name="insert_post")
     */
	public function insertPost(){
		$post = new Post();
		$post->setTitulo('Titulo nuevo');
		$post->setContenido('contenido nuevo');
		$post->setAutor('Admin');
		$post->setFecha(new \DateTime('2017-09-07'));

		$em = $this->getDoctrine()->getManager();
		$em->persist($post);
		$em->flush();
		return new Response( 'Se inserto nueva ID: '.$post->getId() );
	}



	/**
     * @Route("/get/post", name="get_post")
     */
	public function getPost($context = NULL){

		$em = !empty($context) ? $context->getDoctrine()->getManager() : $this->getDoctrine()->getManager(); ///para poder llamar la funcion en el otro controlador
		$repository = $em->getRepository('AppBundle:Post');
		$posts = $repository->findAll();
		//dump($posts);
		//return $post;
		return $posts;
	}



	public function getInfoPost($context = NULL, $id){
		$em = !empty($context) ? $context->getDoctrine()->getManager() : $this->getDoctrine()->getManager(); ///para poder llamar la funcion en el otro controlador
		$post = $em->getRepository('AppBundle:Post')->find($id);
		if(!$post){
			throw $this->createNotFoundException('El post con id: '.$id.' no existe');
			
		}
		return $post;
	}

	/**
	* @Route("/update/post/{id}", name="update_post")
	*/
	public function updatePost($id){
		$em = $this->getDoctrine()->getManager();
		$post = $em->getRepository('AppBundle:Post')->find($id);
		if(!$post){
			throw $this->createNotFoundException('El post con id: '.$id.' no existe');
			
		}
		$post->setTitulo('symfony 3.3 update');
		$post->setContenido('prueba nueva de modificar contenido');
		$post->setAutor('pepito perez');
		$post->setFecha(new \DateTime('2017-07-28'));

		$em->flush();

		return new Response('Se actualizo entrada con Id: '.$id.' ');
	}


	/**
	* @Route("/delete/post/{id}", name="delete_post")
	*/
	public function deletePost($id){
		$em = $this->getDoctrine()->getManager();
		$post = $em->getRepository('AppBundle:Post')->find($id);
		if(!$post){
			throw $this->createNotFoundException('El post con id: '.$id.' no existe');
			
		}
		$em->remove($post);
		$em->flush();

		return new Response('Se borro entrada con Id: '.$id.' ');
	}



}
