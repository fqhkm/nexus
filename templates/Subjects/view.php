<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Subject $subject
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Subject'), ['action' => 'edit', $subject->subject_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Subject'), ['action' => 'delete', $subject->subject_id], ['confirm' => __('Are you sure you want to delete # {0}?', $subject->subject_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Subjects'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Subject'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="subjects view content">
            <h3><?= h($subject->subject_code) ?></h3>
            <table>
                <tr>
                    <th><?= __('Subject Code') ?></th>
                    <td><?= h($subject->subject_code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Subject Name') ?></th>
                    <td><?= h($subject->subject_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Subject Id') ?></th>
                    <td><?= $this->Number->format($subject->subject_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Credit Hour') ?></th>
                    <td><?= $this->Number->format($subject->credit_hour) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>