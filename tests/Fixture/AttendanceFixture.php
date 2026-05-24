<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AttendanceFixture
 */
class AttendanceFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'attendance';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'attendance_id' => 1,
                'student_id' => 1,
                'subject_id' => 1,
                'attendance_date' => '2026-05-21',
                'status' => 'Lorem ipsum dolor ',
            ],
        ];
        parent::init();
    }
}
