<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AttandanceFixture
 */
class AttandanceFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'attandance';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'attandance_id' => 1,
                'student_id' => 1,
                'subject_id' => 1,
                'attandance_date' => '2026-05-19',
            ],
        ];
        parent::init();
    }
}
