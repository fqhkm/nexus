<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;

class AttendanceTable extends Table
{
    /**
     * Initialize method
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        // Menetapkan nama table dalam database
        $this->setTable('attendance');
        
        // ======================================================================
        // NOTA AMAT PENTING (SELESAIKAN ERROR ASSERTION):
        // Check table 'attendance' dekat phpMyAdmin kau sekarang:
        // 1. JIKA ada column 'id' (Auto Increment), guna line bawah ni:
        // 2. JIKA nama column kunci tu 'attendance_id', padam line atas dan buka line ni:
        // $this->setPrimaryKey('attendance_id');

        $this->setPrimaryKey('attendance_id');
        
        // 3. JIKA table ni langsung tak ada Auto Increment (tiada kunci unik tunggal),
        //    padam/komen kedua-dua line setPrimaryKey kat atas.
        // ======================================================================

        // Hubungan ke Table Subjects (Bagi membolehkan dropdown subjek berfungsi)
        $this->belongsTo('Subjects', [
            'foreignKey' => 'subject_id',
            'joinType' => 'INNER',
        ]);

        // Hubungan ke Table Students (Bagi membolehkan validation foreign key 1452 lepas)
        $this->belongsTo('Students', [
            'foreignKey' => 'student_id',
            'joinType' => 'INNER',
        ]);
    }
}