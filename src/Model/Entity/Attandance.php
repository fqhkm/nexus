<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Attendance Entity
 *
 * @property int $attendance_id
 * @property int $student_id
 * @property int $subject_id
 * @property string $status
 * @property \Cake\I18n\FrozenTime $attendance_date
 *
 * @property \App\Model\Entity\Student $student
 * @property \App\Model\Entity\Subject $subject
 */
class Attendance extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it) and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'attendance_id' => true,
        'student_id' => true,
        'subject_id' => true,
        'status' => true,
        'attendance_date' => true,
        'student' => true,
        'subject' => true,
        '*' => true,
    ];
}