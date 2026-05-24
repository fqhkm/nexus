<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    /**
     * 1. Student Dashboard Index 
     */
    public function index()
    {
        $currentUser = $this->request->getSession()->read('Auth.User');
        if (!$currentUser) {
            return $this->redirect(['action' => 'login']);
        }

        $totalStudents = $this->Users->find()->count();
        
        // 📊 CARTA 1: Ambil data pecahan Student mengikut Fakulti
        $facultyData = $this->Users->find()
            ->select(['faculty', 'count' => 'COUNT(*)'])
            ->where(['faculty IS NOT' => null, 'faculty !=' => ''])
            ->group(['faculty'])
            ->disableHydration()
            ->toArray();

        $facultyLabels = [];
        $facultyCounts = [];
        foreach ($facultyData as $data) {
            $facultyLabels[] = $data['faculty'];
            $facultyCounts[] = $data['count'];
        }

        // 🥧 CARTA 2: Ambil data pecahan Student mengikut Semester
        $semesterData = $this->Users->find()
            ->select(['semester', 'count' => 'COUNT(*)'])
            ->where(['semester IS NOT' => null, 'semester !=' => ''])
            ->group(['semester'])
            ->order(['semester' => 'ASC'])
            ->disableHydration()
            ->toArray();

        $semesterLabels = [];
        $semesterCounts = [];
        foreach ($semesterData as $data) {
            $semesterLabels[] = 'Semester ' . $data['semester'];
            $semesterCounts[] = $data['count'];
        }

        // Hantar semua variable ke template index.php
        $this->set(compact('currentUser', 'totalStudents', 'facultyLabels', 'facultyCounts', 'semesterLabels', 'semesterCounts'));
    }

    /**
     * 2. Route Redirection
     */
    public function students()
    {
        return $this->redirect(['controller' => 'Students', 'action' => 'index']);
    }

    /**
     * 3. Student Registration (Sign Up)
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Registration successful! Please log in.'));
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('Registration failed. Please check your form inputs.'));
        }
        $this->set(compact('user'));
    }

    /**
     * 4. User Login
     */
    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        
        $user = $this->Users->newEmptyEntity();
        
        if ($this->request->is('post')) {
            $email = $this->request->getData('email');
            $password = $this->request->getData('password');
            
            $userRecord = $this->Users->find()
                ->where(['email' => $email])
                ->first();
                
            if ($userRecord && ($password === $userRecord->password || password_verify($password, $userRecord->password))) {
                $this->request->getSession()->write('Auth.User', $userRecord->toArray());
                $this->Flash->success(__('Welcome back, ' . h($userRecord->name)));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Your email or password is incorrect.'));
            }
        }
        
        $this->set(compact('user'));
    }

    /**
     * 5. User Profile (With Profile Photo Upload Feature)
     */
    public function profile()
    {
        $currentUser = $this->request->getSession()->read('Auth.User');
        
        if (!$currentUser) {
            $this->Flash->error(__('Your session has expired. Please log in again.'));
            return $this->redirect(['action' => 'login']);
        }

        $user = $this->Users->get($currentUser['id']);

        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();
            
            // 📸 LOGIK MUAT NAIK GAMBAR
            $imageFile = $this->request->getData('upload_image');
            
            if ($imageFile && $imageFile->getError() === UPLOAD_ERR_OK) {
                $fileName = $imageFile->getClientFilename();
                $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                
                // Cipta nama unik contoh: user_1_17189201.jpg bagi mengelakkan nama bertindih
                $newFileName = 'user_' . $user->id . '_' . time() . '.' . $ext;
                
                // Tentukan lokasi folder simpanan: webroot/img/profiles/
                $targetPath = WWW_ROOT . 'img' . DS . 'profiles' . DS;
                
                // Buat folder automatik jika belum wujud
                if (!is_dir($targetPath)) {
                    mkdir($targetPath, 0775, true);
                }
                
                // Alihkan fail dari temporary storage ke folder kekal
                $imageFile->moveTo($targetPath . $newFileName);
                
                // Set nama fail baru ke dalam data entiti database
                $data['profile_image'] = $newFileName;
            }

            $user = $this->Users->patchEntity($user, $data);
            
            if ($this->Users->save($user)) {
                // Update session baru supaya gambar berubah on-the-spot tanpa perlu relog
                $this->request->getSession()->write('Auth.User', $user->toArray());
                
                $this->Flash->success(__('Profile updated successfully!'));
                return $this->redirect(['action' => 'profile']);
            }
            $this->Flash->error(__('Failed to update profile. Please try again.'));
        }

        $this->set(compact('user'));
    }

    /**
     * 6. User Logout
     */
    public function logout()
    {
        $this->request->getSession()->delete('Auth.User');
        $this->Flash->success(__('You have successfully logged out.'));
        return $this->redirect(['action' => 'login']);
    }
}