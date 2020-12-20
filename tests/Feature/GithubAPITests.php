<?php

namespace Tests\Feature;

use App\Http\Services\Github\ApiService;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GithubAPITests extends TestCase
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
}
