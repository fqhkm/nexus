<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Students Controller
 */
class StudentsController extends AppController
{
    /**
     * Halaman Utama Menu Students (localhost/sp_db/students)
     * Membaca terus dari table 'users'
     */
    public function index()
    {
        $currentUser = $this->request->getSession()->read('Auth.User');
        if (!$currentUser) {
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        // Paksa sistem baca table 'users' direct
        $usersTable = $this->fetchTable('Users');
        $students = $usersTable->find()->all();

        $this->set(compact('students', 'currentUser'));
    }
}