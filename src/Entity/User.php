<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id=null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255)]
    private string $email;

    #[ORM\Column(type: 'string', length: 255)]
    private string $password;

    //一个Usercategory可以有很多个user，反之亦然
    #[ORM\ManyToOne(targetEntity: UserCategory::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?UserCategory $category = null;

    //一对一的关联关系，并且在删除 User 实体时，相关的 InfoUser 实体也会被删除（因为使用了 cascade: ['remove']
    #[ORM\OneToOne(targetEntity: InfoUser::class, cascade: ['persist', 'remove'])]
    //表示关联列不能为空，即每个用户必须有相应的用户信息。
    #[ORM\JoinColumn(nullable: false)]
    private ?InfoUser $infoUser = null;

    #[ORM\ManyToOne(targetEntity: Company::class)]
    #[ORM\JoinColumn(nullable: true)]
    //? 符号表示属性可以为 null。在这种情况下，private ?Company $company; 表示 $company 属性可以存储一个 Company 对象或者为空值（null）。这在实际应用中很有用，因为有时用户可能不属于任何企业。
    private ?Company $company= null;

    //一对多关系，表示用户的报名记录，使用 ArrayCollection 初始化。
    #[ORM\OneToMany(targetEntity: Inscription::class, mappedBy: 'user')]
    private Collection $inscriptions;

    //在User类中添加构造函数,初始化 UserCategory，以确保不会将 null 赋值给 UserCategory
    public function __construct(UserCategory $category)
    {
        $this->inscriptions = new ArrayCollection();
        $this->setCategory($category); // Set the category in the constructor to ensure it's never null
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

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getCategory(): UserCategory
    {
        return $this->category;
    }

    public function setCategory(?UserCategory $category): void//需要时允许null
    {
        $this->category = $category;
    }

    public function getInfoUser(): ?InfoUser
    {
        return $this->infoUser;
    }

    public function setInfoUser(?InfoUser $infoUser): void
    {
        $this->infoUser = $infoUser;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): void
    {
        $this->company = $company;
    }

    /**
     * @return Collection<int, Inscription>
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }
    
 //确保User实体中的 addInscription 和 removeInscription 方法正确调用 Inscription 实体中的 setUser 方法。
    public function addInscription(Inscription $inscription): self
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions->add($inscription);
            $inscription->setUser($this);
        }
        return $this;
    }

    public function removeInscription(Inscription $inscription): self
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getUser() === $this) {
                $inscription->setUser(null);
            }
        }

        return $this;
    }
}
