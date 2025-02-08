<?php

declare(strict_types=1);

namespace Kalimeromk\Nbrm;

use Orchestra\Testbench\TestCase;

class NBRMExchangeServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config(['nbrm.base_url' => 'https://www.nbrm.mk/KLServiceNOV/']);
    }

    /**
     * @return void
     */
    public function testGetExchangeRate()
    {
        $service = new NBRMExchangeService();
        $response = $service->getExchangeRate('01.02.2024', '08.02.2024');

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('sreden', $response[0]);
        $this->assertGreaterThan(0, $response[0]['sreden']);
    }

    /**
     * @return void
     */
    public function testGetExchangeRateD()
    {
        $service = new NBRMExchangeService();
        $startDate = date('d-M-Y', strtotime('01.02.2024')); // Пр. 01-Feb-2024
        $endDate = date('d-M-Y', strtotime('08.02.2024'));

        $response = $service->getExchangeRateD($startDate, $endDate);

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('oznaka', $response[0]);
        $this->assertNotEmpty($response[0]['oznaka']);
    }

    /**
     * @return void
     */
    public function testGetExchangeRates()
    {
        $service = new NBRMExchangeService();
        $response = $service->getExchangeRates('01.02.2024', '08.02.2024');

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('datum', $response[0]);
        $this->assertNotEmpty($response[0]['datum']);
    }

    /**
     * @return void
     */
    public function testGetExchangeRatesD()
    {
        $service = new NBRMExchangeService();
        $startDate = date('d-M-Y', strtotime('01.02.2024'));
        $endDate = date('d-M-Y', strtotime('08.02.2024'));

        $response = $service->getExchangeRatesD($startDate, $endDate);

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('valuta', $response[0]);
        $this->assertGreaterThan(0, $response[0]['valuta']);
    }

}
