<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

final class IssueRepository extends EntityRepository
{
    public function resolveIssue(int $id): void
    {
        $issue = $this->find($id);

        if ($issue === null) {
            // TODO: better signaling
            throw new \Exception('No such issue');
        }

        $issue->resolve();
        $this->_em->flush();
    }
}
