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
            <?= $this->Html->link(__('Edit Select Value'), ['action' => 'edit', $selectValue->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Select Value'), ['action' => 'delete', $selectValue->id], ['confirm' => __('Are you sure you want to delete # {0}?', $selectValue->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Select Values'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Select Value'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="selectValues view content">
            <h3><?= h($selectValue->select_key) ?></h3>
            <table>
                <tr>
                    <th><?= __('Select Key') ?></th>
                    <td><?= h($selectValue->select_key) ?></td>
                </tr>
                <tr>
                    <th><?= __('Select Value') ?></th>
                    <td><?= h($selectValue->select_value) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($selectValue->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
