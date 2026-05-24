<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="users view content">
            <h3><?= h($user->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($user->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Student') ?></th>
                    <td><?= $user->hasValue('student') ? $this->Html->link($user->student->matric_id, ['controller' => 'Students', 'action' => 'view', $user->student->student_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Ic Number') ?></th>
                    <td><?= h($user->ic_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Phone Number') ?></th>
                    <td><?= h($user->phone_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Faculty') ?></th>
                    <td><?= h($user->faculty) ?></td>
                </tr>
                <tr>
                    <th><?= __('Course') ?></th>
                    <td><?= h($user->course) ?></td>
                </tr>
                <tr>
                    <th><?= __('Semester') ?></th>
                    <td><?= h($user->semester) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($user->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($user->created) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Users') ?></h4>
                <?php if (!empty($user->users)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Password') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Student Id') ?></th>
                            <th><?= __('Ic Number') ?></th>
                            <th><?= __('Phone Number') ?></th>
                            <th><?= __('Faculty') ?></th>
                            <th><?= __('Course') ?></th>
                            <th><?= __('Semester') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->users as $userRelated) : ?>
                        <tr>
                            <td><?= h($userRelated->id) ?></td>
                            <td><?= h($userRelated->name) ?></td>
                            <td><?= h($userRelated->email) ?></td>
                            <td><?= h($userRelated->password) ?></td>
                            <td><?= h($userRelated->created) ?></td>
                            <td><?= h($userRelated->student_id) ?></td>
                            <td><?= h($userRelated->ic_number) ?></td>
                            <td><?= h($userRelated->phone_number) ?></td>
                            <td><?= h($userRelated->faculty) ?></td>
                            <td><?= h($userRelated->course) ?></td>
                            <td><?= h($userRelated->semester) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $userRelated->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $userRelated->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Users', 'action' => 'delete', $userRelated->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $userRelated->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>