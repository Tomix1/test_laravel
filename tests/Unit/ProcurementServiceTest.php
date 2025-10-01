<?php

namespace Tests\Unit;

use App\Dto\Parameters\OfferParameters;
use App\Dto\Parameters\OptimalProcurementParameters;
use App\Dto\Results\OptimalProcurementDto;
use App\Services\ProcurementService;
use Illuminate\Support\Collection;
use Tests\TestCase;

class ProcurementServiceTest extends TestCase
{
    private ProcurementService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = app(ProcurementService::class);
    }

    public function test_calculate_optimal_procurement()
    {
        $need   = 76;
        $offers = [
            ['id' => 111, 'count' => 42, 'price' => 13, 'pack' => 1],
            ['id' => 222, 'count' => 77, 'price' => 11, 'pack' => 10],
            ['id' => 333, 'count' => 103, 'price' => 10, 'pack' => 50],
            ['id' => 444, 'count' => 65, 'price' => 12, 'pack' => 5],
        ];

        $params = $this->createOptimalProcurementParameters($need, $offers);

        $result = $this->service->calculateOptimal($params);

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertCount(4, $result);

        $this->assertContainsOnlyInstancesOf(OptimalProcurementDto::class, $result);

        $expectedOrder = [111, 222, 333, 444];
        $actualOrder   = $result->pluck('id')->toArray();
        $this->assertEquals($expectedOrder, $actualOrder);

        $this->assertEquals(1, $result->first(fn($dto) => $dto->id === 111)->qty);
        $this->assertEquals(20, $result->first(fn($dto) => $dto->id === 222)->qty);
        $this->assertEquals(50, $result->first(fn($dto) => $dto->id === 333)->qty);
        $this->assertEquals(5, $result->first(fn($dto) => $dto->id === 444)->qty);
    }

    public function test_invalid_count_procurement_optimal()
    {
        $need   = 300;
        $offers = [
            ['id' => 111, 'count' => 42, 'price' => 13, 'pack' => 1],
            ['id' => 222, 'count' => 77, 'price' => 11, 'pack' => 10],
            ['id' => 333, 'count' => 103, 'price' => 10, 'pack' => 50],
            ['id' => 444, 'count' => 65, 'price' => 12, 'pack' => 5],
        ];

        $params = $this->createOptimalProcurementParameters($need, $offers);

        $result = $this->service->calculateOptimal($params);

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertTrue($result->isEmpty());
    }

    public function test_inappropriate_pack_multiplicity()
    {
        $need   = 12;
        $offers = [
            ['id' => 111, 'count' => 20, 'price' => 10, 'pack' => 5],
            ['id' => 222, 'count' => 10, 'price' => 12, 'pack' => 3],
        ];

        $params = $this->createOptimalProcurementParameters($need, $offers);

        $result = $this->service->calculateOptimal($params);

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertTrue($result->isEmpty());
    }

    private function createOptimalProcurementParameters(int $need, array $offers): OptimalProcurementParameters
    {
        return new OptimalProcurementParameters(
            need:   $need,
            offers: collect($offers)->map(
                        static fn($offer) => new OfferParameters(
                            id:    $offer['id'],
                            count: $offer['count'],
                            price: $offer['price'],
                            pack:  $offer['pack'],
                        )
                    )
        );
    }
}
