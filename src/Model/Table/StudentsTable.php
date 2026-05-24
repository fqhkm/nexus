<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;

class StudentsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        // Paksa model ini membaca table 'students' dalam phpMyAdmin
        $this->setTable('students');
        
        // PENTING: Beritahu CakePHP yang primary key awak ialah student_id (bukan id)
        $this->setPrimaryKey('student_id'); 

        // Hubungkan ke table users berasaskan foreign key user_id
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
    }
}