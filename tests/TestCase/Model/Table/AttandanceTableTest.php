<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AttandanceTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AttandanceTable Test Case
 */
class AttandanceTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AttandanceTable
     */
    protected $Attandance;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Attandance',
        'app.Students',
        'app.Subjects',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Attandance') ? [] : ['className' => AttandanceTable::class];
        $this->Attandance = $this->getTableLocator()->get('Attandance', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Attandance);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\AttandanceTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\AttandanceTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
