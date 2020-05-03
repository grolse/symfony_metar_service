<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StatusController extends AbstractController
{

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *
     * @Route("/", name="api.status", methods={"GET"})
     */
    public function __invoke()
    {
        return $this->json(
          [
              'status' => 'ok',
              'server_time' => (new \DateTime())->format('Y m d H:i:s')
          ]
        );
    }
}