<?php

namespace App\Tests\Service;

use App\Entity\News;
use App\Entity\User;
use App\Entity\UserBookmark;
use App\Generator\ResponseGenerator;
use App\Model\BookmarkListRequest;
use App\Repository\UserBookmarkRepository;
use App\Repository\UserRepository;
use App\Service\BookmarkService;
use App\Service\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validation;

class BookmarkServiceTestPhpTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->validator = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
        $this->userBookmarkRepository = $this->createMock(UserBookmarkRepository::class);
        $this->userRepository = $this->createMock(UserRepository::class);
        $this->responseGenerator = new ResponseGenerator();
        $this->userService = $this->createMock(UserService::class);
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->mockLogger = $this->createMock(LoggerInterface::class);

        $this->bookmarkService = new BookmarkService(
            $this->validator,
            $this->userBookmarkRepository,
            $this->userRepository,
            $this->responseGenerator,
            $this->userService,
            $this->entityManager,
            $this->mockLogger
        );

    }

    /**
     * @throws Exception
     */
    public function testValidateBookmarkCreateRequestReturnsAValidObject(): void
    {
        $parameters = [
            'userId' => '1',
            'newsId' => 'test_test',
            'webPublicationDate' => '2023-10-11 10:00:00',
            'webTitle' => 'test_test_title',
            'webUrl' => 'http:/www.url.com',
        ];
        $request = new Request($parameters);

        $result = $this->bookmarkService->validateRequest($request);

        $this->assertEquals('1', $result->getUserId());
        $this->assertEquals('test_test', $result->getNewsId());
        $this->assertEquals('2023-10-11 10:00:00', $result->getWebPublicationDate());
        $this->assertEquals('test_test_title', $result->getWebTitle());
        $this->assertEquals('http:/www.url.com', $result->getWebUrl());
    }

    public function testInvalidRequestExpectsToThrowAnError(): void
    {
        $parameters = [
            'userId' => '',
            'newsId' => 1,
            'webPublicationDate' => 1,
            'webTitle' => 'test_test_title',
            'webUrl' => 'http:/www.url.com',
        ];
        $request = new Request($parameters);

        $this->expectException(Exception::class);

        $this->bookmarkService->validateRequest($request);
    }

    public function testValidateListRequestExpectsToReturnAValidResponseObject(): void
    {
        $parameters = [
            'userId' => '1',
        ];
        $request = new Request($parameters);
        $result = $this->bookmarkService->validateListRequest($request);
        $this->assertEquals('1', $result->getUserId());
    }

    public function testValidateListRequestExpectsToThrowAnErrorForInvalidRequest(): void
    {
        $parameters = [
            'userId' => '',
        ];
        $request = new Request($parameters);
        $this->expectException(Exception::class);
        $result = $this->bookmarkService->validateListRequest($request);
    }

    public function testListBookmarkExpectsToReturnAValidBookmarkResponse(): void
    {
        $user = new User();
        $news = new News();
        $news->setNewsId('1');
        $news->setWebPublicationDate(new \DateTimeImmutable('now'));
        $news->setWebTitle('testing');
        $news->setWebUrl('www.testing.com');
        $this->userService->method('getUser')->willReturn($user);

        $userBookmark = new UserBookmark();
        $userBookmark->setNews($news);
        $userBookmark->setUser($user);

        $this->userBookmarkRepository->method('findBy')->willReturn([$userBookmark]);
        $request = new BookmarkListRequest();
        $request->setUserId('1');
        $result = $this->bookmarkService->list($request);

        $this->assertEquals(1, $result->getCount());
        $this->assertEquals(1, $result->getNews()[0]['id']);
        $this->assertEquals('testing', $result->getNews()[0]['webTitle']);
        $this->assertEquals('www.testing.com', $result->getNews()[0]['webUrl']);
    }

}
