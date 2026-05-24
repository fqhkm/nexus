<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'password' => 'Lorem ipsum dolor sit amet',
                'created' => '2026-05-19 17:39:35',
                'student_id' => 'Lorem ipsum dolor sit amet',
                'ic_number' => 'Lorem ipsum dolor ',
                'phone_number' => 'Lorem ipsum dolor ',
                'faculty' => 'Lorem ipsum dolor sit amet',
                'course' => 'Lorem ipsum dolor sit amet',
                'semester' => 'Lorem ipsum dolor ',
            ],
        ];
        parent::init();
    }
}
