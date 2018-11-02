<?php

namespace App\Entity;

use App\Entity\Issue;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * @Entity(repositoryClass="App\Repository\SprintRepository")
 */
class Sprint
{
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
    private $name;

    /**
     * @var User
     *
     * @ManyToOne(targetEntity="User")
     * @JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @var iterable<issue>&Collection&Selectable
     *
     * @ManyToMany(targetEntity="Issue")
     */
    private $issues;

    /**
     * @var bool
     *
     * @Column(type="boolean")
     */
    private $started;

    /**
     * @var \DateTimeImmutable
     *
     * @Column(type="datetime_immutable", nullable=true)
     */
    private $startDate;

    public function __construct(string $name, User $owner, array $issues)
    {
        $this->name = $name;
        $this->owner = $owner;
        $this->issues = new ArrayCollection($issues);
        $this->started = false;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOwner(): User
    {
        return $this->owner;
    }

    /**
     * @return iterable<Issue>&Collection&Selectable
     */
    public function getIssues(): Collection
    {
        return $this->issues;
    }

    public function addIssue(Issue $issue): self
    {
        $this->issues->add($issue);

        return $this;
    }

    public function isStarted(): bool
    {
        return $this->started;
    }

    public function getStartDate(): ?\DateTimeImmutable
    {
        return $this->startDate;
    }

    public function start(): self
    {
        $this->started = true;
        $this->startDate = new \DateTimeImmutable();

        return $this;
    }
}
