<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;

/**
 * @Entity(repositoryClass="App\Repository\IssueRepository")
 */
class Issue
{
    const TYPE_BUG = 'bug';

    const TYPE_TASK = 'task';

    /**
     * @var int
     *
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    private $title;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    private $description;

    /**
     * @var int
     *
     * @Column(type="integer")
     */
    private $points;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    private $type;

    /**
     * @var \DateTimeImmutable
     *
     * @Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @var bool
     *
     * @Column(type="boolean")
     */
    private $resolved;

    public function __construct(
        string $title,
        string $description,
        int $points,
        string $type
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->points = $points;
        $this->type = $type;
        $this->createdAt = new \DateTimeImmutable();
        $this->resolved = false;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPoints(): int
    {
        return $this->points;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function isResolved(): bool
    {
        return $this->resolved;
    }

    public function resolve(): self
    {
        $this->resolved = true;

        return $this;
    }
}
