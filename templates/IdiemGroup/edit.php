<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\IdiemGroup $idiemGroup
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $idiemGroup->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $idiemGroup->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Idiem Group'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="idiemGroup form content">
            <?= $this->Form->create($idiemGroup) ?>
            <fieldset>
                <legend><?= __('Edit Idiem Group') ?></legend>
                <?php
                    echo $this->Form->control('valor');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
