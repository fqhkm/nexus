<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Collection\CollectionInterface|string[] $subjects
 */
?>

<div class="container-fluid" style="padding: 30px; background-color: #f1f5f9; min-height: 100vh;">
    <div class="row">
        <div class="column">
            
            <div class="card-portal" style="background: #ffffff; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); padding: 30px; margin-bottom: 30px;">
                <h3 style="color: #1e3a8a; font-weight: 700; margin-bottom: 25px; display: flex; align-items: center; gap: 10px; font-size: 1.4rem;">
                    <svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="currentColor" d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z" /></svg>
                    Rekod Kehadiran Baru
                </h3>
                
                <?= $this->Form->create($attendance) ?>
                
                <div style="display: flex; flex-wrap: wrap; gap: 20px; align-items: flex-end;">
                    
                    <div style="flex: 1; min-width: 200px;">
                        <label style="font-weight: 600; color: #475569; margin-bottom: 8px; display: block;">ID Pelajar</label>
                        <input type="text" value="20231844449" disabled style="background-color: #e2e8f0; color: #64748b; padding: 10px; border-radius: 8px; border: 1px solid #cbd5e1; width: 100%; font-weight: bold; cursor: not-allowed;">
                    </div>
                    
                    <div style="flex: 2; min-width: 300px;">
                        <label style="font-weight: 600; color: #475569; margin-bottom: 8px; display: block;">Pilih Subjek Kuliah</label>
                        <?= $this->Form->select('subject_id', $subjects, [
                            'empty' => '-- Sila Pilih Subjek --',
                            'style' => 'width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #cbd5e1; background-color: #f8fafc;'
                        ]) ?>
                    </div>
                    
                    <div style="flex: 1; min-width: 150px;">
                        <label style="font-weight: 600; color: #475569; margin-bottom: 8px; display: block;">Status</label>
                        <?= $this->Form->select('status', [
                            'Hadir' => 'Hadir', 
                            'Absen' => 'Absen', 
                            'Bersebab' => 'Bersebab'
                        ], [
                            'style' => 'width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #cbd5e1; background-color: #f8fafc;'
                        ]) ?>
                    </div>
                    
                </div>
                
                <div style="margin-top: 25px;">
                    <?= $this->Form->button(__('Sahkan Kehadiran'), [
                        'class' => 'button', 
                        'style' => 'background: #2563eb; border: none; color: white; padding: 12px 25px; border-radius: 8px; font-weight: 600; cursor: pointer;'
                    ]) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>

            <div class="card-portal" style="background: #ffffff; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); padding: 30px;">
                <h3 style="color: #1e3a8a; font-weight: 700; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; font-size: 1.4rem;">
                    <svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="currentColor" d="M13.5,8H12V13L16.28,15.54L17,14.33L13.5,12.25V8M13,3A9,9 0 0,0 4,12H1L4.96,16.03L5,16L9,12H6A7,7 0 0,1 13,5A7,7 0 0,1 20,12A7,7 0 0,1 13,19C11.07,19 9.32,18.21 8.06,16.94L6.64,18.36C8.27,20 10.5,21 13,21A9,9 0 0,0 22,12A9,9 0 0,0 13,3Z" /></svg>
                    Rekod Sejarah Kehadiran
                </h3>
                
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                        <thead>
                            <tr style="background-color: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                                <th style="padding: 12px; text-align: left; color: #475569; font-weight: 600;">Tarikh</th>
                                <th style="padding: 12px; text-align: left; color: #475569; font-weight: 600;">ID Pelajar</th>
                                <th style="padding: 12px; text-align: left; color: #475569; font-weight: 600;">ID Subjek</th>
                                <th style="padding: 12px; text-align: left; color: #475569; font-weight: 600;">Status Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="4" style="text-align: center; color: #94a3b8; padding: 30px; font-style: italic;">
                                    Tiada rekod kehadiran ditemui.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>