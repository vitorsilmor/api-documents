<?php

namespace Tests\Feature\Services\Users\CreateNewUserService;

use App\Models\User;
use App\Repositories\CompanyRepository;
use App\Repositories\UserRepository;
use App\Services\Users\CreateNewUser\CreateNewUserService;
use Mockery;
use Tests\TestCase;

class CreateNewUserServiceTest extends TestCase
{
    public function testShouldReturnANewUser()
    {
        $user = new User();
        $user->email = "john.doe@mail.com";
        $user->company_id = '1';

        $dataToCreateUser = [
            'company_id' => '1',
            'email' => 'john.doe@mail.com',
            'password' => '123456'
        ];

        $mockedUserRepository = (object) Mockery::instanceMock(UserRepository::class);
        $mockedUserRepository
            ->shouldReceive('userEmailExists')
            ->withArgs([$dataToCreateUser['email']])
            ->andReturn(false);

        $mockedCompanyRepository = (object) Mockery::instanceMock(CompanyRepository::class);
        $mockedCompanyRepository
            ->shouldReceive('companyExists')
            ->withArgs([$dataToCreateUser['company_id']])
            ->andReturn(true);

        $mockedUserRepository
            ->shouldReceive('createNewUser')
            ->andReturn($user);

        $service = new CreateNewUserService();

        $service->setUserRepository($mockedUserRepository)
            ->setCompanyRepository($mockedCompanyRepository);

        $newUser = $service->handle($dataToCreateUser);

        $this->assertInstanceOf(User::class, $newUser);
        $this->assertEquals($dataToCreateUser['email'], $newUser->email);
    }

    public function testShouldFailBecauseCompanyNotExists()
    {
        $this->expectExceptionMessage("Company is not registred");

        $user = new User();
        $user->email = "john.doe@mail.com";
        $user->company_id = '1';

        $dataToCreateUser = [
            'company_id' => 1,
            'email' => 'john.doe@mail.com'
        ];

        $mockedCompanyRepository = (object) Mockery::instanceMock(CompanyRepository::class);
        $mockedCompanyRepository
            ->shouldReceive('companyExists')
            ->withArgs([$dataToCreateUser['company_id']])
            ->andReturn(false);

        $service = new CreateNewUserService();

        $service->setCompanyRepository($mockedCompanyRepository);

        $service->handle($dataToCreateUser);
    }

    public function testShouldFailBecauseEmailAlreadyExists()
    {
        $this->expectExceptionMessage("User email alredy registred");

        $user = new User();
        $user->email = "john.doe@mail.com";
        $user->company_id = '1';

        $dataToCreateUser = [
            'company_id' => 1,
            'email' => 'john.doe@mail.com'
        ];

        $mockedUserRepository = (object) Mockery::instanceMock(UserRepository::class);
        $mockedUserRepository
            ->shouldReceive('userEmailExists')
            ->withArgs([$dataToCreateUser['email']])
            ->andReturn(true);

        $mockedCompanyRepository = (object) Mockery::instanceMock(CompanyRepository::class);
        $mockedCompanyRepository
            ->shouldReceive('companyExists')
            ->withArgs([$dataToCreateUser['company_id']])
            ->andReturn(true);

        $mockedUserRepository
            ->shouldReceive('createNewUser')
            ->withArgs([$dataToCreateUser])
            ->andReturn($user);
        $service = new CreateNewUserService();

        $service->setUserRepository($mockedUserRepository)
            ->setCompanyRepository($mockedCompanyRepository);

        $service->handle($dataToCreateUser);
    }
}
