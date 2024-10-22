<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\SelectValue> $selectValues
 */
?>
<div class="selectValues index content">
    <?= $this->Html->link(__('New Select Value'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Select Values') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('select_key') ?></th>
                    <th><?= $this->Paginator->sort('select_value') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($selectValues as $selectValue): ?>
                <tr>
                    <td><?= $this->Number->format($selectValue->id) ?></td>
                    <td><?= h($selectValue->select_key) ?></td>
                    <td><?= h($selectValue->select_value) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $selectValue->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $selectValue->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $selectValue->id], ['confirm' => __('Are you sure you want to delete # {0}?', $selectValue->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
