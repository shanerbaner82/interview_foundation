<?php

namespace Tests\Unit;

use App\Http\Services\Github\ApiService;
use App\User;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GithubAPITest extends TestCase
{

    use WithFaker;

    /**
     * @var string
     */
    private $testData;

    public function setUp(): void
    {
        parent::setUp();
        $data = file_get_contents('tests/Datasets/StarredRepos.json');
        $data = utf8_encode($data);
        $this->testData = json_decode($data);
    }

    /** @test */
    public function api_service_returns_github_stars()
    {
        $service = \Mockery::mock(ApiService::class);

        GitHub::shouldReceive('getFactory->make->me->starring->all')
                ->andReturn($this->testData);

        $service->shouldReceive('getStarredRepositories')
                ->andReturn($this->testData);

        $this->assertTrue($service->getStarredRepositories() === $this->testData);
    }

    /** @test */
    public function an_authorized_user_with_a_token_can_retrieve_their_stars()
    {
        GitHub::shouldReceive('getFactory->make->me->starring->all')
            ->andReturn($this->testData);

        $token = $this->faker()->word;

        $user = factory(User::class)->make(['token' => $token]);

        $this->actingAs($user);

        $this->getJson(route('stars.get'))->assertSuccessful();

    }
}
