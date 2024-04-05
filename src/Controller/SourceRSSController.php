<?php

namespace App\Controller;

use App\Entity\SourceRSS;
use App\Form\SourceRSSType;
use App\Repository\SourceRSSRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/source/rss')]
class SourceRSSController extends AbstractController
{
    #[Route('/', name: 'app_source_r_s_s_index', methods: ['GET'])]
    public function index(SourceRSSRepository $sourceRSSRepository, SerializerInterface $serializer): Response
    {
        $sourceRSSes = $sourceRSSRepository->findAll();

        $jsonSourceRSSes = $serializer->serialize($sourceRSSes, 'json');

        return $this->render('source_rss/index.html.twig', [
            'source_r_s_ses' => $jsonSourceRSSes,
        ]);
    }

    #[Route('/new', name: 'app_source_r_s_s_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sourceRSS = new SourceRSS();
        $form = $this->createForm(SourceRSSType::class, $sourceRSS);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($sourceRSS);
            $entityManager->flush();

            return $this->redirectToRoute('app_source_r_s_s_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('source_rss/new.html.twig', [
            'source_r_s_s' => $sourceRSS,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_source_r_s_s_show', methods: ['GET'])]
    public function show(SourceRSS $sourceRSS): Response
    {
        return $this->render('source_rss/show.html.twig', [
            'source_r_s_s' => $sourceRSS,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_source_r_s_s_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SourceRSS $sourceRSS, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SourceRSSType::class, $sourceRSS);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_source_r_s_s_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('source_rss/edit.html.twig', [
            'source_r_s_s' => $sourceRSS,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_source_r_s_s_delete', methods: ['POST'])]
    public function delete(Request $request, SourceRSS $sourceRSS, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sourceRSS->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($sourceRSS);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_source_r_s_s_index', [], Response::HTTP_SEE_OTHER);
    }
}
