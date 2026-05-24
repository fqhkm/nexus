<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AttendanceTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AttendanceTable Test Case
 */
class AttendanceTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AttendanceTable
     */
    protected $Attendance;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Attendance',
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
        $config = $this->getTableLocator()->exists('Attendance') ? [] : ['className' => AttendanceTable::class];
        $this->Attendance = $this->getTableLocator()->get('Attendance', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Attendance);

        parent::tearDown();
    }
}
