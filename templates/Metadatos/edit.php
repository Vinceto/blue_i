<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Metadato $metadato
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $metadato->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $metadato->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Metadatos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="metadatos form content">
            <?= $this->Form->create($metadato) ?>
            <fieldset>
                <legend><?= __('Edit Metadato') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('label');
                    echo $this->Form->control('group_id');
                    echo $this->Form->control('service_id');
                    echo $this->Form->control('tag');
                    echo $this->Form->control('selectData');
                    echo $this->Form->control('visibility');
                    echo $this->Form->control('is_required');
                    echo $this->Form->control('created_at', ['empty' => true]);
                    echo $this->Form->control('updated_at', ['empty' => true]);
                    echo $this->Form->control('deleted_at', ['empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
