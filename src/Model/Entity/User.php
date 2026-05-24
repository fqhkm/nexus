<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class User extends Entity
{
    // Mengaktifkan true pada semua kolom baru database supaya boleh disimpan
    // Ditambah keyword 'array' bagi mengelakkan Fatal Error Type mismatch
   protected array $_accessible = [
    'name' => true,
    'email' => true,
    'phone' => true,
    'ic_number' => true,
    'faculty' => true,
    'course' => true,
    'semester' => true,
    'student_id' => true,
    'password' => true,
    'profile_image' => true, // 👈 PASTIKAN BARIS INI ADA!
    '*' => true,
];
}