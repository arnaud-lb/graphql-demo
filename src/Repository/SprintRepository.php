<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

final class SprintRepository extends EntityRepository
{
    public function paginateSprints(int $offset, int $limit): array
    {
        $dql = '
            SELECT  s
            FROM    App\Entity\Sprint s
            ORDER   BY s.id
        ';

        $query = $this->_em->createQuery($dql)
            ->setFirstResult($offset)
            ->setMaxResults($limit);

        return $query->getResult();
    }

    public function startSprint(int $id): void
    {
        $sprint = $this->find($id);

        if (null === $sprint) {
            // TODO: proper signaling
            throw new \Exception('No such sprint');
        }

        $sprint->start();
        $this->_em->flush();
    }
}
