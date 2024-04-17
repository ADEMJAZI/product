<?

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\Category;

class CategoryTest extends KernelTestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testFillCategories(): void
    {
        $category = new Category($this->entityManager);
        $names = ['Category 1', 'Category 2', 'Category 3'];

        $category->fillCategories($names);

        $repository = $this->entityManager->getRepository(Category::class);
        $categories = $repository->findAll();

        $this->assertCount(3, $categories);

        // Check if the names of categories are correct
        foreach ($categories as $index => $category) {
            $this->assertEquals($names[$index], $category->getName());
        }
    }
}
