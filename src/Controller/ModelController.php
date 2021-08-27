<?php

namespace App\Controller;

use App\Entity\Model;
use App\Form\ModelFormType;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function PHPUnit\Framework\throwException;

class ModelController extends AbstractController
{

    /**
     * @Route("/modelDetail/{id}", name="modelDetail")
     */
    public function ModelDetail(Model $model, $id )
    {
        $model = $this->getDoctrine()->getRepository(Model::class)->find($id);

        return $this->render('model/ModelDetail.html.twig', [
            'model' => $model,
        ]);
    }
    
    /**
     * @Route("/model", name= "model")
     */
    public function index(): Response
    {
        $model = $this -> getDoctrine() -> getRepository(Model:: class) -> findAll();
        return $this->render(
            'model/ModelIndex.html.twig',
            [
                'Models' => $model,
            ]
        );
    }

    /**
     * @Route("/modelCreate", name= "modelCreate")
     */
    public function ModelCreate(Request $request){
        $model = new Model();
        $form = $this -> createForm(ModelFormType:: class, $model);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $Images = $model -> getImage();

            $fileName = md5(uniqid());
            $fileExtension = $Images->guessExtension();
            $imageName = $fileName . '.' . $fileExtension;
            
            try {
                $Images->move(
                    $this->getParameter('model_image'), $imageName
                );
            } catch (FileException $e) {
                throwException($e);
            }
            $model->setImage($imageName);


            $manager = $this->getDoctrine()->getManager();
            $manager->persist($model);
            $manager->flush();

            $this->addFlash("Success","Create product succeed !");
            return $this->redirectToRoute("model");
        }

        return $this->render( 
            'model/ModelCreate.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/modelUpdate/{id}", name= "modelUpdate")
     */
    public function ModelUpdate(Request $request, $id)
    {
        $model = $this->getDoctrine()->getRepository(Model::class)->find($id);
        $form = $this->createForm(ModelFormType::class,$model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($model);
            $manager->flush();

            $this->addFlash("Success","Update model succeed !");
            return $this->redirectToRoute("model");
        } 
        return $this->render( 
            'model/ModelUpdate.html.twig',
            [
                'form' => $form->createView()
            ]
        );    
    
    }

    /**
     * @Route("/modelDelete/{id}", name= "modelDelete")
     */
    public function ModelDelete($id) {
        $model = $this->getDoctrine()->getRepository(Model::class)->find($id);

        if ($model == null) {
            $this->addFlash("Error","Invalid Product ID");
            return $this->redirectToRoute("model");
        }

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($model);
        $manager->flush();

        $this->addFlash("Success","Product book succeed !");
        return $this->redirectToRoute('model');
    }
}
