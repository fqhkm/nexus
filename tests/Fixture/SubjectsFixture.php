<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SubjectsFixture
 */
class SubjectsFixture extends TestFixture
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
                'subject_id' => 1,
                'subject_code' => 'Lorem ipsum dolor sit amet',
                'subject_name' => 'Lorem ipsum dolor sit amet',
                'credit_hour' => 1,
            ],
        ];
        parent::init();
    }
}
