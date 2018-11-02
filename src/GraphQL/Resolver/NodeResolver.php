<?php

namespace App\GraphQL\Resolver;

use App\Entity\Issue;
use App\Entity\Sprint;
use App\Entity\User;
use App\Repository\IssueRepository;
use App\Repository\SprintRepository;
use App\Repository\UserRepository;
use App\GraphQL\Resolver\IssueResolver;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;
use Overblog\GraphQLBundle\Relay\Node\GlobalId;

final class NodeResolver implements ResolverInterface, AliasedInterface
{
    /** @var UserRepository */
    private $userRepository;

    /** @var SprintRepository */
    private $sprintRepository;

    /** @var IssueRepository */
    private $issueRepository;

    /** @var IssueResolver */
    private $issueResolver;

    public function __construct(
        UserRepository $userRepository,
        SprintRepository $sprintRepository,
        IssueRepository $issueRepository,
        IssueResolver $issueResolver
    ) {
        $this->userRepository = $userRepository;
        $this->sprintRepository = $sprintRepository;
        $this->issueRepository = $issueRepository;
        $this->issueResolver = $issueResolver;
    }

    /** @return object */
    public function node(string $globalId)
    {
        $parsed = GlobalId::fromGlobalId($globalId);
        $id = $parsed['id'];
        $type = $parsed['type'];

        // Ideally, we would remove this switch
        switch ($type) {
            case 'User':
                return $this->userRepository->find($id);
            case 'Sprint':
                return $this->sprintRepository->find($id);
            case 'Bug':
            case 'Task':
                return $this->issueRepository->find($id);
        }
    }

    /** @param object $value */
    public function type($value): string
    {
        // Ideally, we would remove this switch
        switch (true) {
            case $value instanceof User:
                return 'User';
            case $value instanceof Sprint:
                return 'Sprint';
            case $value instanceof Issue:
                return $this->issueResolver->type($value);
        }

        throw new \Exception(sprintf('Unknown class %s', get_class($value)));
    }

    public static function getAliases(): array
    {
        return [
            'node' => 'node_id_fetcher',
            'type' => 'node_type',
        ];
    }
}
