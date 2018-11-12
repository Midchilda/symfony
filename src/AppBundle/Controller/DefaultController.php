<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Product;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function homeAction(Request $request)
    {
        //caturar el repositorio de la Tabla contra la DB
        $productRepository = $this->getDoctrine()->getRepository(Product::class);
        //findAll definido en doctrine, devuelve un array
        //$products= $productRepository->findAll();
        $products= $productRepository->findByTop(1);
        //para pasar los datos a la plantilla, añadir parametros al render

       // var_dump($products);
        // replace this example code with whatever you need
        return $this->render('frontal/index.html.twig',array('products'=>$products));
    }
     /**
     * @Route("/nosotros", name="nosotros")
     */
    public function nosotrosAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('frontal/nosotros.html.twig');
    }

     /**
     * @Route("/contactar/{sitio}", name="contactar")
     */
    public function contactarAction(Request $request,$sitio="todos")
    {
        // replace this example code with whatever you need
        //pasamos una variable $sitio atraves del array, a la plantilla con twig
        return $this->render('frontal/locations.html.twig',array("sitio"=>$sitio));
    }
     /**
     * @Route("/producto/{id}", name="producto")
     */
    public function productoAction(Request $request,$id=null)
    {
        // replace this example code with whatever you need
        //pasamos una variable $sitio atraves del array, a la plantilla con twig
        if ($id != null) {
                //caturar el repositorio de la Tabla contra la DB
            $productRepository = $this->getDoctrine()->getRepository(Product::class);
            $product= $productRepository->find($id);
            return $this->render('frontal/producto.html.twig',array("product"=>$product));
        }
        else {
            return $this->redirectToRoute('homepage');
        }
        
    }

}
