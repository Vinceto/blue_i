<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SelectValue $selectValue
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $selectValue->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $selectValue->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Select Values'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="selectValues form content">
            <?= $this->Form->create($selectValue) ?>
            <fieldset>
                <legend><?= __('Edit Select Value') ?></legend>
                <?php
                    echo $this->Form->control('select_key');
                    echo $this->Form->control('select_value');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
