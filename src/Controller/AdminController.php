<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;

use App\Entity\Project;
use App\Entity\Render;
use App\Form\ProjectType;
use App\Form\RenderType;
use App\Repository\ProjectRepository;

#[Route('/admin', name: 'admin.')]
class AdminController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function index(ProjectRepository $projectRepository): Response
    {
        $projects = $projectRepository->findAll();

        return $this->render('admin/dashboard.html.twig', [
            'projects' => $projects
        ]);
    }

    #[Route('/add/project', name: 'add_project')]
    public function addProject(Request $request, PersistenceManagerRegistry $doctrine): Response
    {
        $project = new Project();

        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted())
        {
            $projectName = $form->getData()->getName();
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $projectName)));

            $em = $doctrine->getManager();
            
            $file = $request->files->get('project')['video'];
            if ($file)
            {
                $filename = md5(uniqid()).'.'.$file->guessClientExtension();
                $file->move($this->getParameter('uploads_directory').'video/projects/'.$slug.'/', $filename);

                $project->setVideo($filename);
                $project->setSlug($slug);
            
                $em->persist($project);
                $em->flush();
            }

            return $this->redirect($this->generateUrl('admin.add_project'));
        }

        return $this->render('admin/project.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/add/render', name: 'add_render')]
    public function addRender(Request $request, PersistenceManagerRegistry $doctrine): Response
    {
        $render = new Render();

        $form = $this->createForm(RenderType::class, $render);
        $form->handleRequest($request);

        if ($form->isSubmitted())
        {
            $project = $form->getData()->getProject();

            $projectName = $form->getData()->getProject()->getName();

            $em = $doctrine->getManager();

            $file = $request->files->get('render')['image'];
            if ($file)
            {
                $filename = md5(uniqid()).'.'.$file->guessClientExtension();
                $file->move($this->getParameter('uploads_directory').'images/renders/'.$projectName.'/', $filename);

                $render->setImage($filename);
                
                $em->persist($render);
                $em->flush();
            }

            return $this->redirect($this->generateUrl('admin.add_render'));
        }

        return $this->render('admin/render.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
