<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\ORM\EntityRepository;

final class UserRepository extends EntityRepository
{
    public function firstUser(): User
    {
        return $this->findOneBy([], [
            'id' => 'ASC',
        ]);
    }
}
