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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $subject->subject_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $subject->subject_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Subjects'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="subjects form content">
            <?= $this->Form->create($subject) ?>
            <fieldset>
                <legend><?= __('Edit Subject') ?></legend>
                <?php
                    echo $this->Form->control('subject_code');
                    echo $this->Form->control('subject_name');
                    echo $this->Form->control('credit_hour');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
