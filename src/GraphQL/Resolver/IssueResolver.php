<?php

namespace App\GraphQL\Resolver;

use App\Entity\Issue;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

final class IssueResolver implements ResolverInterface, AliasedInterface
{
    public function type(Issue $value): string
    {
        switch ($value->getType()) {
            case Issue::TYPE_BUG:
                return 'Bug';
            case Issue::TYPE_TASK:
                return 'Task';
        }

        throw new \Exception();
    }

    public static function getAliases(): array
    {
        return ['type' => 'issue_type'];
    }
}
