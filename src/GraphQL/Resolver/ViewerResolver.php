<?php

namespace App\GraphQL\Resolver;

use App\Entity\User;
use App\Repository\SprintRepository;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;
use Overblog\GraphQLBundle\Relay\Connection\Output\Connection;
use Overblog\GraphQLBundle\Relay\Connection\Paginator;

final class ViewerResolver implements ResolverInterface, AliasedInterface
{
    /** @var SprintRepository */
    private $sprintRepository;

    public function __construct(SprintRepository $sprintRepository)
    {
        $this->sprintRepository = $sprintRepository;
    }

    public function sprints(Argument $args): Connection
    {
        $paginator = new Paginator(function ($offset, $limit) {
            return $this->sprintRepository->paginateSprints(
                $offset ?? 0,
                $limit ?? 10
            );
        });

        $connection = $paginator->forward($args);
        assert($connection instanceof Connection);

        return $connection;
    }

    public function user(User $value): User
    {
        return $value;
    }

    public static function getAliases(): array
    {
        return [
            'sprints' => 'viewer_sprints',
            'user' => 'viewer_user',
        ];
    }
}
