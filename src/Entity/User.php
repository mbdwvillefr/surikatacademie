<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id=null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\ManyToOne(targetEntity: UserCategory::class)]
    #[ORM\JoinColumn(nullable: false)]
    private UserCategory $category;

    #[ORM\ManyToOne(targetEntity: Company::class)]
    #[ORM\JoinColumn(nullable: true)]
    //? 符号表示属性可以为 null。在这种情况下，private ?Company $company; 表示 $company 属性可以存储一个 Company 对象或者为空值（null）。这在实际应用中很有用，因为有时用户可能不属于任何企业。
    private ?Company $company;

    public function __construct(string $name, UserCategory $category, ?Company $company = null)
    {
        $this->name = $name;
        $this->category = $category;
        $this->company = $company;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCategory(): UserCategory
    {
        return $this->category;
    }

    public function setCategory(UserCategory $category): void
    {
        $this->category = $category;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): void
    {
        $this->company = $company;
    }
}
