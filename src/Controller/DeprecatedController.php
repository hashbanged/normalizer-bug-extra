<?php

namespace App\Controller;

use App\Dto\DeprecatedUserDto;
use App\Service\Serializer\DtoSerializer;
use App\Service\UserDataProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeprecatedController extends AbstractController
{
    public function __construct(
        private DtoSerializer $dtoSerializer,
        private UserDataProvider $userDataProvider
    ) {
    }

    #[Route('/deprecated', name: 'deprecated')]
    public function __invoke(): Response
    {
        $userData = $this->userDataProvider->getData();

        $userDto = new DeprecatedUserDto($userData['first_name'], $userData['last_name'], $userData['profile']);
        $userDto->includeProfile();

        $serializedData = $this->dtoSerializer->serialize($userDto);

        return new Response($serializedData, 200, [
            'Content-Type' => 'application/json',
        ]);
    }
}
