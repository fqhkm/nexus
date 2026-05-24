<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Student Entity
 *
 * @property int $student_id
 * @property int $user_id
 * @property string $matric_id
 * @property string $course
 * @property int $semester
 * @property string $phone
 * @property string $address
 *
 * @property \App\Model\Entity\User $user
 */
class Student extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'user_id' => true,
        'matric_id' => true,
        'course' => true,
        'semester' => true,
        'phone' => true,
        'address' => true,
        'user' => true,
    ];
}
