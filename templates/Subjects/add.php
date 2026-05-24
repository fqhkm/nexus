<?php
/**
 * @var \App\View\AppView $this
 * @var mixed $subject
 */
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal - Register New Subject</title>
    <style>
        *{ margin:0; padding:0; box-sizing:border-box; font-family:'Poppins', sans-serif; }
        body{ min-height:100vh; background:#f4f6f9; color:#333; padding-bottom: 40px; }
        
        .navbar { background: #1e3a8a; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 12px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 1000; }
        .nav-brand { color: white; font-size: 20px; font-weight: bold; text-decoration: none; }
        .nav-links { display: flex; gap: 15px; list-style: none; align-items: center; }
        .nav-item a { color: rgba(255,255,255,0.75); text-decoration: none; padding: 8px 16px; border-radius: 6px; font-size: 15px; }
        .nav-item a:hover { color: white; background: rgba(255,255,255,0.1); }
        .nav-item.active a { color: white; background: #2563eb; font-weight: 600; }
        .btn-logout { background: #ef4444; color: white !important; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: bold; }

        .main-container { max-width: 600px; margin: 40px auto; padding: 0 20px; }
        .dashboard-card { background: white; padding: 35px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
        
        h2 { color: #1e3a8a; font-size: 22px; margin-bottom: 25px; border-bottom: 2px solid #f0fdf4; padding-bottom: 10px; display: flex; align-items: center; gap: 10px; }
        
        .form-group { margin-bottom: 25px; }
        .form-group label { font-weight: 600; color: #475569; margin-bottom: 8px; display: block; font-size: 14px; }
        .form-group input { width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #cbd5e1; background-color: #f8fafc; font-size: 14px; color: #334155; transition: all 0.2s; }
        .form-group input:focus { outline: none; border-color: #2563eb; background-color: #fff; box-shadow: 0 0 0 3px rgba(37,99,235,0.1); }
        
        .action-flex { display: flex; gap: 12px; margin-top: 30px; }
        .btn-submit { background: #10b981; color: white; border: none; padding: 12px 25px; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 14px; flex: 1; text-align: center; }
        .btn-submit:hover { background: #059669; }
        .btn-cancel { background: #94a3b8; color: white; text-decoration: none; padding: 12px 25px; border-radius: 8px; font-weight: 600; font-size: 14px; flex: 1; text-align: center; }
        .btn-cancel:hover { background: #64748b; }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="/sp_db/users" class="nav-brand">🎓 Student Portal</a>
        <ul class="nav-links">
            <li class="nav-item"><a href="/sp_db/users">Dashboard</a></li>
            <li class="nav-item"><a href="/sp_db/students">Students</a></li>
            <li class="nav-item"><a href="/sp_db/attendance">Attendance</a></li>
            <li class="nav-item active"><a href="/sp_db/subjects">Subjects</a></li>
            <li><a href="/sp_db/users/logout" class="btn-logout">Log Out</a></li>
        </ul>
    </nav>

    <div class="main-container">
        <?= $this->Flash->render() ?>

        <div class="dashboard-card">
            <h2>✨ Daftar Subjek Baru</h2>
            
            <?= $this->Form->create($subject, ['url' => ['action' => 'add']]) ?>
            
                <div class="form-group">
                    <label>Kod Subjek (Subject Code)</label>
                    <?= $this->Form->control('subject_code', [
                        'label' => false, 
                        'type' => 'text',
                        'placeholder' => 'Contoh: IMS562',
                        'required' => true
                    ]) ?>
                </div>
                
                <div class="form-group">
                    <label>Nama Subjek (Subject Name)</label>
                    <?= $this->Form->control('subject_name', [
                        'label' => false, 
                        'type' => 'text',
                        'placeholder' => 'Contoh: Database Management Systems',
                        'required' => true
                    ]) ?>
                </div>

                <div class="form-group">
                    <label>Jam Kredit (Credit Hour)</label>
                    <?= $this->Form->control('credit_hour', [
                        'label' => false, 
                        'type' => 'number',
                        'placeholder' => 'Contoh: 3',
                        'required' => true
                    ]) ?>
                </div>
                
                <div class="action-flex">
                    <?= $this->Form->button(__('Simpan Subjek'), ['class' => 'btn-submit']) ?>
                    <a href="/sp_db/subjects" class="btn-cancel">Batal</a>
                </div>
                
            <?= $this->Form->end() ?>
        </div>
    </div>

</body>
</html>