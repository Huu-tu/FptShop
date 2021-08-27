<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

use function PHPUnit\Framework\throwException;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name= "category")
     */
    public function index()
    {
        $category = $this -> getDoctrine() -> getRepository(Category:: class) -> findAll();
        return $this->render(
            'category/CategoryIndex.html.twig',
            [
                'categories' => $category,
            ]
        );
    }

    // /**
    //  * @Route("/categoryCreate", name= "categoryCreate")
    //  */
    // public function CategoryCreate(Request $request){
    //     $category = new Category();
    //     $form = $this -> createForm(CategoryFormType:: class, $category);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $manager = $this->getDoctrine()->getManager();
    //         $manager->persist($category);
    //         $manager->flush();

    //         $this->addFlash("Success","Create category succeed !");
    //         return $this->redirectToRoute("category");
    //     }

    //     return $this->render( 
    //         'category/CategoryCreate.html.twig',
    //         [
    //             'form' => $form->createView()
    //         ]
    //     );
    // }

/**
     * @Route("/categoryCreate", name= "categoryCreate")
     */
    public function CategoryCreate(Request $request){
        $category = new Category();
        $form = $this -> createForm(CategoryFormType:: class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $Images = $category -> getImage();

            $fileName = md5(uniqid());
            $fileExtension = $Images->guessExtension();
            $imageName = $fileName . '.' . $fileExtension;
            
            try {
                $Images->move(
                    $this->getParameter('category_image'), $imageName
                );
            } catch (FileException $e) {
                throwException($e);
            }
            $category->setImage($imageName);


            $manager = $this->getDoctrine()->getManager();
            $manager->persist($category);
            $manager->flush();

            $this->addFlash("Success","Create product succeed !");
            return $this->redirectToRoute("category");
        }

        return $this->render( 
            'category/CategoryCreate.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/categoryUpdate/{id}", name= "categoryUpdate")
     */
    public function CategoryUpdate(Request $request, $id)
    {
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);
        $form = $this->createForm(CategoryFormType::class,$category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($category);
            $manager->flush();

            $this->addFlash("Success","Update category succeed !");
            return $this->redirectToRoute("category");
        } 
        return $this->render( 
            'category/CategoryUpdate.html.twig',
            [
                'form' => $form->createView()
            ]
        );    
    
    }

    /**
     * @Route("/categoryDelete/{id}", name= "categoryDelete")
     */
    public function CategoryDelete($id) {
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);

        if ($category == null) {
            $this->addFlash("Error","Invalid Product ID");
            return $this->redirectToRoute("category");
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($category);
        $manager->flush();

        $this->addFlash("Success","Product book succeed !");
        return $this->redirectToRoute('category');
    }

    /**
     * @Route("/categoryDetail/{id}", name="categoryDetail")
     */
    public function detailcategory ($id)
    {
        $category = $this->getDoctrine()->getRepository(Category::class)->find($id);
        
        return $this->render(
            "category/CategoryDetail.html.twig",
            [
              'category' => $category
            ]
        );
    }
}
