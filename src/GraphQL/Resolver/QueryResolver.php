<?php

namespace App\GraphQL\Resolver;

use App\Entity\User;
use App\Repository\UserRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

final class QueryResolver implements ResolverInterface, AliasedInterface
{
    /** @var UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function viewer(): User
    {
        return $this->userRepository->firstUser();
    }

    public static function getAliases(): array
    {
        return ['viewer' => 'query_viewer'];
    }
}
