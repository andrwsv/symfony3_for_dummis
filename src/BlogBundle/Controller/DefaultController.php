<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    /**
     * @Route("/list/{page}", name="blog_list", requirements={"page":"\d+"})
     * @Method({"GET"})
     */
    //@Route("/")
    public function indexAction($page=1)
    {
        return $this->render('BlogBundle:Default:index.html.twig', 
        	array(
        			'page'=>$page
        		));
    }

    /**
     * @Route("/producto", name="productos_list")
     * @Method({"GET"})
     */
    public function listProducto(Request $request)
    {
        return new Response(
        	'<html><body>Nro de productos: '.$request->get('nro').'</body></html>'
        );
    }


    /**
     * @Route("/producto/new", name="cms_producto_new")
     * @Method({"POST"})
     */
    public function newProducto(Request $request)
    {
        return new Response(
        	json_encode($request->request->all())
        );
    }


    /**
     * @Route("/producto/{id}/edit", name="cms_producto_edit")
     * @Method({"PUT"})
     */
    public function editProducto($id)
    {
        return new Response(
        	'Editar producto id: '.$id
        );
    }

    /**
     * @Route("/producto/{id}", name="cms_producto_delete")
     * @Method({"DELETE"})
     */
    public function deleteProducto($id)
    {
        return new Response(
        	'Borrar producto id: '.$id
        );
    }



}
