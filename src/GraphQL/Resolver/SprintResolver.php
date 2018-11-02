<?php

namespace App\GraphQL\Resolver;

use App\Entity\Sprint;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;
use Overblog\GraphQLBundle\Relay\Connection\Output\Connection;
use Overblog\GraphQLBundle\Relay\Connection\Paginator;

final class SprintResolver implements ResolverInterface, AliasedInterface
{
    public function issues(Sprint $sprint, Argument $args): Connection
    {
        $filter = $args['filter'] ?? [];
        $type = $filter['type'] ?? null;

        $paginator = new Paginator(function ($offset, $limit) use ($sprint, $type) {
            return $sprint->getIssues($type)->slice($offset, $limit);
        });

        $connection = $paginator->forward($args);
        assert($connection instanceof Connection);

        return $connection;
    }

    public static function getAliases(): array
    {
        return ['issues' => 'sprint_issues'];
    }
}
