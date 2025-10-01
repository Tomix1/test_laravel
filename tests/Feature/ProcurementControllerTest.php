<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProcurementControllerTest extends TestCase
{
    public function test_successful_procurement_optimal()
    {
        $data = [
            'need'   => 76,
            'offers' => [
                ['id' => 111, 'count' => 42, 'price' => 13, 'pack' => 1],
                ['id' => 222, 'count' => 77, 'price' => 11, 'pack' => 10],
                ['id' => 333, 'count' => 103, 'price' => 10, 'pack' => 50],
                ['id' => 444, 'count' => 65, 'price' => 12, 'pack' => 5],
            ],
        ];

        $response = $this->getJson(route('api.procurement.optimal', $data));

        $response->assertStatus(200)
                 ->assertJson(
                     [
                         'data' => [
                             ['id' => 111, 'qty' => 1],
                             ['id' => 222, 'qty' => 20],
                             ['id' => 333, 'qty' => 50],
                             ['id' => 444, 'qty' => 5],
                         ],
                     ]
                 );
    }

    public function test_invalid_count_procurement_optimal()
    {
        $data = [
            'need'   => 300,
            'offers' => [
                ['id' => 111, 'count' => 42, 'price' => 13, 'pack' => 1],
                ['id' => 222, 'count' => 77, 'price' => 11, 'pack' => 10],
                ['id' => 333, 'count' => 103, 'price' => 10, 'pack' => 50],
                ['id' => 444, 'count' => 65, 'price' => 12, 'pack' => 5],
            ],
        ];

        $response = $this->getJson(route('api.procurement.optimal', $data));

        $response->assertStatus(200)
                 ->assertJson([]);
    }

    public function test_inappropriate_pack_multiplicity()
    {
        $data = [
            'need'   => 12,
            'offers' => [
                ['id' => 111, 'count' => 20, 'price' => 10, 'pack' => 5],
                ['id' => 222, 'count' => 10, 'price' => 12, 'pack' => 3],
            ],
        ];

        $response = $this->getJson(route('api.procurement.optimal', $data));

        $response->assertStatus(200)
                 ->assertJson([]);
    }
}
