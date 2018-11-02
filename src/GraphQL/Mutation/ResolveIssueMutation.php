<?php

namespace App\GraphQL\Mutation;

use App\Repository\IssueRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;
use Overblog\GraphQLBundle\Relay\Node\GlobalId;

final class ResolveIssueMutation implements MutationInterface, AliasedInterface
{
    /** @var IssueRepository */
    private $issueRepository;

    public function __construct(IssueRepository $issueRepository)
    {
        $this->issueRepository = $issueRepository;
    }

    public function execute(string $globalIssueId): array
    {
        $parsed = GlobalId::fromGlobalId($globalIssueId);
        $id = $parsed['id'];

        $this->issueRepository->resolveIssue($id);

        return [
            'issue' => $this->issueRepository->find($id),
        ];
    }

    public static function getAliases(): array
    {
        return ['execute' => 'resolve_issue'];
    }
}
