<?php

namespace App\Tests\Unit;

use App\Entity\Article;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = new User();
    }

    public function testGetEmail(): void
    {
        $value = 'test@test.fr';

        $response = $this->user->setEmail($value);

        self::assertInstanceOf(User::class, $response);
        self::assertEquals($value,$this->user->getEmail());
        self::assertEquals($value,$this->user->getUserIdentifier());
    }

    public function testGetRoles(): void
    {
        $value = ['ROLE_ADMIN'];

        $response = $this->user->setRoles($value);

        self::assertInstanceOf(User::class, $response);
        self::assertContains('ROLE_USER', $this->user->getRoles());
        self::assertContains('ROLE_ADMIN', $this->user->getRoles());
    }

    public function testGetPassword(): void
    {
        $value = 'password';

        $response = $this->user->setPassword($value);

        self::assertInstanceOf(User::class, $response);
        self::assertEquals($value, $this->user->getPassword());
    }

    public function testGetArticle(): void
    {
        $value = new Article();

        $response = $this->user->addArticle($value);

        self::assertInstanceOf(User::class, $response);
        self::assertCount(1, $this->user->getArticles());
        self::assertTrue($this->user->getArticles()->contains($value));

        $response = $this->user->removeArticle($value);

        self::assertInstanceOf(User::class, $response);
        self::assertCount(0, $this->user->getArticles());
        self::assertFalse($this->user->getArticles()->contains($value));

    }

    public function testGetArticles(): void
    {
        $value = new Article();
        $value1 = new Article();
        $value2 = new Article();

         $this->user->addArticle($value);
         $this->user->addArticle($value1);
         $this->user->addArticle($value2);


        self::assertCount(3, $this->user->getArticles());
        self::assertTrue($this->user->getArticles()->contains($value));
        self::assertTrue($this->user->getArticles()->contains($value1));
        self::assertTrue($this->user->getArticles()->contains($value2));

        $response = $this->user->removeArticle($value);

        self::assertInstanceOf(User::class, $response);
        self::assertCount(2, $this->user->getArticles());
        self::assertFalse($this->user->getArticles()->contains($value));
        self::assertTrue($this->user->getArticles()->contains($value1));
        self::assertTrue($this->user->getArticles()->contains($value2));

        $response = $this->user->removeArticle($value1);

        self::assertInstanceOf(User::class, $response);
        self::assertCount(1, $this->user->getArticles());
        self::assertFalse($this->user->getArticles()->contains($value));
        self::assertFalse($this->user->getArticles()->contains($value1));
        self::assertTrue($this->user->getArticles()->contains($value2));

    }
}