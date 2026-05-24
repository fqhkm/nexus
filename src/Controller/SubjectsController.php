<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;

class SubjectsController extends AppController
{
    /**
     * Index method - Papar senarai subjek dalam jadual
     */
    public function index()
    {
        $subjects = $this->Subjects->find()->all();
        $this->set(compact('subjects'));
    }

    /**
     * Add method - Simpan maklumat pendaftaran dari form terus ke DB table subjects
     */
    public function add()
    {
        $subject = $this->Subjects->newEmptyEntity();
        
        if ($this->request->is('post')) {
            // Ambil data (subject_code, subject_name, credit_hour)
            $subject = $this->Subjects->patchEntity($subject, $this->request->getData());
            
            if ($this->Subjects->save($subject)) {
                $this->Flash->success(__('Subjek baru berjaya disimpan masuk ke dalam database!'));
                return $this->redirect(['action' => 'index']);
            }
            
            $this->Flash->error(__('Gagal mendaftar subjek. Sila semak semula input anda.'));
        }
        
        $this->set(compact('subject'));
    }
}