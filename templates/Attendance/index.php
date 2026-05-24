<?php
/**
 * @var \App\View\AppView $this
 * @var iterable $records
 * @var \App\Model\Entity\Attendance $attendance
 * @var \Cake\Collection\CollectionInterface $subjects
 */
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal - Track Attendance</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        *{ margin:0; padding:0; box-sizing:border-box; font-family:'Poppins', sans-serif; }
        body{ min-height:100vh; background:#f4f6f9; color:#333; padding-bottom: 40px; }
        .navbar { background: #1e3a8a; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 4px 12px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 1000; }
        .nav-brand { color: white; font-size: 20px; font-weight: bold; text-decoration: none; display: flex; align-items: center; gap: 10px; }
        .nav-links { display: flex; gap: 15px; list-style: none; align-items: center; }
        .nav-item a { color: rgba(255,255,255,0.75); text-decoration: none; padding: 8px 16px; border-radius: 6px; font-size: 15px; }
        .nav-item a:hover { color: white; background: rgba(255,255,255,0.1); }
        .nav-item.active a { color: white; background: #2563eb; font-weight: 600; }
        .btn-logout { background: #ef4444; color: white !important; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: bold; }
        .main-container { max-width: 1200px; margin: 40px auto; padding: 0 20px; }
        
        .history-card { background: white; padding: 35px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); margin-bottom: 30px; }
        h2 { color: #1e3a8a; font-size: 24px; margin-bottom: 25px; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px; display: flex; align-items: center; gap: 10px; }
        
        .form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 25px; }
        .form-group { display: flex; flex-direction: column; gap: 6px; }
        .form-group label { font-size: 14px; font-weight: 500; color: #475569; }
        .form-control { width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px; background: #f8fafc; transition: all 0.3s; }
        .form-control:focus { outline: none; border-color: #2563eb; background: white; }
        .btn-submit { background: #2563eb; color: white; padding: 14px 28px; border: none; border-radius: 8px; font-weight: 600; font-size: 14px; cursor: pointer; transition: background 0.2s; }
        .btn-submit:hover { background: #1e40af; }
        
        table { width: 100%; border-collapse: collapse; font-size: 14px; text-align: left; }
        th { background: #f8fafc; color: #1e3a8a; padding: 15px; font-weight: 600; border-bottom: 2px solid #e2e8f0; }
        td { padding: 15px; border-bottom: 1px solid #e2e8f0; color: #475569; }
        tr:hover { background: #f8fafc; }
        
        .badge-present { background: #dcfce7; color: #166534; padding: 4px 12px; border-radius: 6px; font-weight: bold; font-size: 13px; }
        .badge-absent { background: #fee2e2; color: #991b1b; padding: 4px 12px; border-radius: 6px; font-weight: bold; font-size: 13px; }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="#" class="nav-brand">🎓 Student Portal</a>
        <ul class="nav-links">
            <li class="nav-item"><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>">Dashboard</a></li>
            <li class="nav-item"><a href="<?= $this->Url->build(['controller' => 'Students', 'action' => 'index']) ?>">Students</a></li>
            <li class="nav-item active"><a href="<?= $this->Url->build(['controller' => 'Attendance', 'action' => 'index']) ?>">Attendance</a></li>
            <li class="nav-item"><a href="<?= $this->Url->build(['controller' => 'Subjects', 'action' => 'index']) ?>">Subjects</a></li>
            <li><?= $this->Html->link(__('Log Out'), ['controller' => 'Users', 'action' => 'logout'], ['class' => 'btn-logout']) ?></li>
        </ul>
    </nav>

    <div class="main-container">
        <?= $this->Flash->render() ?>

        <div class="history-card">
            <h2><i class="fa-solid fa-user-check"></i> Rekod Kehadiran Baru</h2>
            
            <?= $this->Form->create($attendance) ?>
            <div class="form-grid">
                
                <div class="form-group">
                    <label>ID Pelajar (Mesti wujud dalam jadual students)</label>
                    <?= $this->Form->control('student_id', [
                        'label' => false, 
                        'class' => 'form-control', 
                        'placeholder' => 'Masukkan ID Pelajar yang sah', 
                        'required' => true,
                        'type' => 'text'
                    ]) ?>
                </div>
                
                <div class="form-group">
                    <label>Pilih Subjek Kuliah</label>
                    <?= $this->Form->control('subject_id', [
                        'label' => false, 
                        'class' => 'form-control', 
                        'type' => 'select',
                        'options' => $subjects,
                        'empty' => '-- Pilih Subjek Kuliah --',
                        'required' => true
                    ]) ?>
                </div>
                
                <div class="form-group">
                    <label>Status</label>
                    <?= $this->Form->control('status', [
                        'label' => false, 
                        'class' => 'form-control', 
                        'type' => 'select',
                        'options' => ['Hadir' => 'Hadir', 'Tidak Hadir' => 'Tidak Hadir']
                    ]) ?>
                </div>
            </div>
            <?= $this->Form->button(__('Sahkan Kehadiran'), ['class' => 'btn-submit']) ?>
            <?= $this->Form->end() ?>
        </div>

        <div class="history-card">
            <h2><i class="fa-solid fa-clock-rotate-left"></i> Rekod Sejarah Kehadiran</h2>
            <div style="overflow-x: auto;">
                <table>
                    <thead>
                        <tr>
                            <th>Tarikh</th>
                            <th>ID Pelajar</th>
                            <th>ID Subjek</th>
                            <th>Status Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($records)): ?>
                            <?php foreach ($records as $row): ?>
                            <tr>
                                <td><?= h($row->attendance_date) ?></td>
                                <td style="font-weight: bold; color: #1e3a8a;"><?= h($row->student_id) ?></td>
                                <td>Subjek #<?= h($row->subject_id) ?></td>
                                <td>
                                    <span class="<?= $row->status == 'Hadir' ? 'badge-present' : 'badge-absent' ?>">
                                        <?= h($row->status) ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" style="text-align: center; padding: 30px; color: #94a3b8; font-weight: 500;">
                                    Tiada sebarang rekod sejarah pendaftaran kehadiran dijumpai.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>