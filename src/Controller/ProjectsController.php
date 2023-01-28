<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\RenderRepository;
use App\Repository\ProjectRepository;

#[Route('/projects', name: 'projects.')]
class ProjectsController extends AbstractController
{
    #[Route('/{project}', name: 'projects')]
    public function projects(Request $request, ProjectRepository $projectRepository): Response
    {
        $projectSlug = $request->get('project');

       // $renderData = $renderRepository->findByProjectSlug($projectSlug);
        $projectData = $projectRepository->findByProjectSlug($projectSlug);

        if (!$projectData)
        {
            return $this->redirect($this->generateUrl('home'));
        }

        $renderData = $projectData->getRenders();

        return $this->render('projects/project.html.twig', [
            'renderData' => $renderData,
            'projectData' => $projectData
        ]);
    }

    /*#[Route('/modern-house', name: 'modern_house')]
    public function modernHouse(RenderRepository $renderRepository): Response
    {
        $projectData = $renderRepository->findBy(['project' => 'modern house']);

        return $this->render('projects/modern-house.html.twig', [
            'projectData' => $projectData
        ]);
    }

    #[Route('/franklins-house', name: 'franklins_house')]
    public function franklinsHouse(RenderRepository $renderRepository): Response
    {
        $projectData = $renderRepository->findBy(['project' => 'franklins house']);

        return $this->render('projects/franklin-house.html.twig', [
            'projectData' => $projectData
        ]);
    }*/
}
