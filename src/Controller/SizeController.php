<?php

namespace App\Controller;

use App\Entity\Size;
use App\Form\SizeFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class SizeController extends AbstractController
{

    /**
     * @Route("/size", name= "size")]
     */
    public function index(): Response
    {
        $size = $this -> getDoctrine() -> getRepository(Size:: class) -> findAll();
        return $this->render(
            'size/SizeIndex.html.twig',
            [
                'sizes' => $size,
            ]
        );
    }

    /**
     * @Route("/sizeCreate", name= "sizeCreate")]
     */
    public function SizeCreate(Request $request){
        $size = new Size();
        $form = $this -> createForm(SizeFormType:: class, $size);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($size);
            $manager->flush();

            $this->addFlash("Success","Create size succeed !");
            return $this->redirectToRoute("size");
        }

        return $this->render( 
            'size/SizeCreate.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/sizeUpdate/{id}", name= "sizeUpdate")]
     */
    public function SizeUpdate(Request $request, $id)
    {
        $size = $this->getDoctrine()->getRepository(Size::class)->find($id);
        $form = $this->createForm(SizeFormType::class,$size);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($size);
            $manager->flush();

            $this->addFlash("Success","Update size succeed !");
            return $this->redirectToRoute("size");
        } 
        return $this->render( 
            'size/SizeUpdate.html.twig',
            [
                'form' => $form->createView()
            ]
        );    
    
    }

    /**
     * @Route("/sizeDelete/{id}", name= "sizeDelete")]
     */
    public function SizeDelete($id) {
        $size = $this->getDoctrine()->getRepository(Size::class)->find($id);

        if ($size == null) {
            $this->addFlash("Error","Invalid Product ID");
            return $this->redirectToRoute("size");
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($size);
        $manager->flush();

        $this->addFlash("Success","Product book succeed !");
        return $this->redirectToRoute('size');
    }
}
