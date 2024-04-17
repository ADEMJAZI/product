<?php
use PHPUnit\Framework\TestCase;
use App\Entity\Voitur;
use App\Repository\VoiturRepository;

class VoiturTest extends TestCase
{
    /**
     * @dataProvider carsData
     */
    public function testCountCarsWithSameColorAndModel($color, $model, $expectedCount)
    {
        $voitur = new Voitur();
        $voitur->setCol($color);
        $voitur->setModel($model);

        $repository = $this->createMock(VoiturRepository::class);
        $repository->expects($this->any())
            ->method('findAll')
            ->willReturn([
                (new Voitur())->setCol('red')->setModel('toyota'),
                (new Voitur())->setCol('red')->setModel('toyota'),
                (new Voitur())->setCol('blue')->setModel('honda'),
                (new Voitur())->setCol('green')->setModel('toyota'),
            ]);

        $result = $voitur->countCarsWithSameColorAndModel($repository);
        $this->assertSame($expectedCount, $result);
    }

    public function carsData()
    {
        return [
            ['red', 'toyota', 2],  
            ['blue', 'honda', 1],  
            ['green', 'ford', 0],  
        ];
    }
}




?>