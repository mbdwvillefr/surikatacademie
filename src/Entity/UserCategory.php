<?php

namespace App\Entity;

use App\Repository\UserCategoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: UserCategoryRepository::class)]
//注解标识该类为一个 Doctrine 实体，并指定了关联的存储库类 UserCategoryRepository
class UserCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name = null;//在需要时允许null

    //一个category可以有一个或很多个user
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'category')]
    private Collection $users;//users 是一个Collection类型，表示一个类别可以有多个用户。通过mappedBy属性指定反向关系的映射


    public function __construct()
    {
        //ArrayCollection是Doctrine集合（Collection）接口的一个具体实现，用于存储和操作一组对象（类似于数组，但提供了更多的功能）。
        //在当前对象中，创建一个新的ArrayCollection实例，并将其赋值给users属性
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
//addUser方法添加用户到 users 集合，如果用户不存在于集合中，并设置用户的类别为当前类别。
        if (!$this->users->contains($user)) {
             $this->users ->add($user);
             
        }

        return $this;
    }

}
