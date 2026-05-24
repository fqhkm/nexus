<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\FrozenTime; // Ditambah untuk menguruskan data tarikh sistem otomatis

class AttendanceController extends AppController
{
    /**
     * Index method - Redirect automatik ke page borang (add)
     */
    public function index()
    {
        return $this->redirect(['action' => 'add']);
    }

    /**
     * Add method - Memapar Borang & Memproses Simpanan Kehadiran
     */
    public function add()
    {
        $attendance = $this->Attendance->newEmptyEntity();
        
        if ($this->request->is('post')) {
            $attendance = $this->Attendance->patchEntity($attendance, $this->request->getData());
            
            // 🛠️ FIX 1: Memandangkan input ID Pelajar di-disable pada borang UI,
            // kita masukkan nilainya secara manual di dalam controller sebelum disimpan.
            $attendance->student_id = '20231844449'; 
            
            // 🛠️ FIX 2: Menetapkan tarikh masa secara automatik mengikut masa server.
            // *Nota: Jika nama column tarikh di phpMyAdmin anda ialah 'tarikh' atau 'created',
            // sila tukar perkataan 'attendance_date' di bawah mengikut nama column tersebut.
            $attendance->attendance_date = FrozenTime::now(); 
            
            if ($this->Attandance->save($attandance)) {
                $this->Flash->success(__('Kehadiran berjaya disahkan!'));
                return $this->redirect(['action' => 'add']);
            }
            
            // Sila buka komen (buang tanda //) pada baris di bawah jika masih bermasalah untuk membaca ralat terperinci:
            // dd($attendance->getErrors());
            
            $this->Flash->error(__('Gagal mengesahkan kehadiran. Sila cuba lagi.'));
        }
        
        // Membaca semua data subjek secara fleksibel tanpa trigger error path null
        $allSubjects = $this->Attendance->Subjects->find()->all();
        
        $subjects = [];
        foreach ($allSubjects as $sub) {
            $key = $sub->get('id') ?? $sub->get('subject_id') ?? $sub->get('id_subject');
            $value = $sub->get('name') ?? $sub->get('subject_name') ?? $sub->get('title') ?? $sub->get('subject_code');
            
            if ($key !== null) {
                $subjects[$key] = $value;
            }
        }
        
        $this->set(compact('attendance', 'subjects'));
    }
}