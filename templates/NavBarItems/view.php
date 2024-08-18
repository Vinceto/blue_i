<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NavBarItem $navBarItem
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Nav Bar Item'), ['action' => 'edit', $navBarItem->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Nav Bar Item'), ['action' => 'delete', $navBarItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $navBarItem->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Nav Bar Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Nav Bar Item'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="navBarItems view content">
            <h3><?= h($navBarItem->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($navBarItem->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Url') ?></th>
                    <td><?= h($navBarItem->url) ?></td>
                </tr>
                <tr>
                    <th><?= __('Role') ?></th>
                    <td><?= $navBarItem->hasValue('role') ? $this->Html->link($navBarItem->role->name, ['controller' => 'Roles', 'action' => 'view', $navBarItem->role->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($navBarItem->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
