<?php

namespace App\Controller;

use App\Entity\Touit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TouitController extends AbstractController
{
    #[Route('/api/touits', name: 'get_all_touits', methods: ['GET'])]
    public function getAllTouits(EntityManagerInterface $em): JsonResponse
    {
        $touits = $em->getRepository(Touit::class)->findBy([], ['createdAt' => 'DESC']);
        return new JsonResponse($touits);
    }

    #[Route('/api/touits', name: 'create_touit', methods: ['POST'])]
    public function createTouit(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Validation des données
        if (!is_string($data['contenu'] ?? null) || !is_string($data['author'] ?? null)) {
            return new JsonResponse(['error' => 'Invalid data type'], 400);
        }

        if (empty($data['contenu']) || empty($data['author'])) {
            return new JsonResponse(['error' => 'Invalid data'], 400);
        }

        $touit = new Touit();
        $touit->setContenu($data['contenu']);
        $touit->setAuthor($data['author']);
        $touit->setCreatedAt(new \DateTimeImmutable());

        $em->persist($touit);
        $em->flush();

        return new JsonResponse(['status' => 'Touit created!'], 201);
    }

    #[Route('/api/touits/{id}', name: 'delete_touit', methods: ['DELETE'])]
    public function deleteTouit(int $id, EntityManagerInterface $em): JsonResponse
    {
        $touit = $em->getRepository(Touit::class)->find($id);

        if (!$touit) {
            return new JsonResponse(['error' => 'Touit not found'], 404);
        }

        $em->remove($touit);
        $em->flush();

        return new JsonResponse(['status' => 'Touit deleted'], 204);
    }
}
