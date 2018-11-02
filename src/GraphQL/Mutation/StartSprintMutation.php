<?php

namespace App\GraphQL\Mutation;

use App\Repository\SprintRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;
use Overblog\GraphQLBundle\Error\UserError;
use Overblog\GraphQLBundle\Relay\Node\GlobalId;

final class StartSprintMutation implements MutationInterface, AliasedInterface
{
    /** @var SprintRepository */
    private $sprintRepository;

    public function __construct(SprintRepository $sprintRepository)
    {
        $this->sprintRepository = $sprintRepository;
    }

    public function execute(string $sprintGlobalId): array
    {
        $parsed = GlobalId::fromGlobalId($sprintGlobalId);
        $id = $parsed['id'];

        $this->sprintRepository->startSprint($id);

        return [
            'sprint' => $this->sprintRepository->find($id),
        ];
    }

    public static function getAliases(): array
    {
        return ['execute' => 'start_sprint'];
    }
}
