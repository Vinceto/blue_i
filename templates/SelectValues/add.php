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
            <?= $this->Html->link(__('List Select Values'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="selectValues form content">
            <?= $this->Form->create($selectValue) ?>
            <fieldset>
                <legend><?= __('Add Select Value') ?></legend>
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
