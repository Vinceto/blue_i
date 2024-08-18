<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NavBarItem $navBarItem
 * @var \Cake\Collection\CollectionInterface|string[] $roles
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Nav Bar Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="navBarItems form content">
            <?= $this->Form->create($navBarItem) ?>
            <fieldset>
                <legend><?= __('Add Nav Bar Item') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('url');
                    echo $this->Form->control('role_id', ['options' => $roles, 'empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
