<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\Trait\TimestampableEntity;
use App\Repository\MessageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(
    mercure: true,
    paginationEnabled: false,
    normalizationContext: ['groups' => ['get:Messages']]
    // denormalizationContext: ['groups' => ['write:Message']]
)]

#[ApiFilter(SearchFilter::class, properties: ['userId' => 'exact', 'game' => 'exact'])]


#[ApiResource(
    paginationEnabled: false,
    uriTemplate: '/user/{id}/messages',
    uriVariables: [
        'id' => new Link(
            fromClass: User::class,
            fromProperty: 'message'
        )
    ],
    operations: [new GetCollection()]
)]

class Message
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('get:Messages')]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[ApiProperty(types: ["https://schema.org/name"])]
    #[Groups(['get:Users', 'write:Message', 'get:Games', 'get:Messages'])]
    #[Assert\NotBlank]
    private ?string $message = null;

    #[ORM\ManyToOne(inversedBy: 'message')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['get:Users', 'write:Message', 'get:Messages'])]
    private ?User $userId = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['get:Users', 'write:Message', 'get:Messages'])]
    private ?Game $game = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): self
    {
        $this->game = $game;

        return $this;
    }
}