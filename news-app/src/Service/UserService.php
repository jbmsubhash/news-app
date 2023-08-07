<?php
namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Exception;

class UserService
{

    public function __construct(
        private readonly UserRepository $userRepository,
    ) {
    }

    /**
     * @throws Exception
     */
    public function getUser(string $userId): ?User
    {
        $user = $this->userRepository->findOneBy([
            'id' => $userId,
        ]);

        if(!$user) {
            throw new Exception("invalid user");
        }
        return $user;
    }
}