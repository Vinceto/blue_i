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
            <?= $this->Html->link(__('Edit Metadato'), ['action' => 'edit', $metadato->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Metadato'), ['action' => 'delete', $metadato->id], ['confirm' => __('Are you sure you want to delete # {0}?', $metadato->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Metadatos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Metadato'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="metadatos view content">
            <h3><?= h($metadato->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($metadato->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Label') ?></th>
                    <td><?= h($metadato->label) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tag') ?></th>
                    <td><?= h($metadato->tag) ?></td>
                </tr>
                <tr>
                    <th><?= __('SelectData') ?></th>
                    <td><?= h($metadato->selectData) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($metadato->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Group Id') ?></th>
                    <td><?= $metadato->group_id === null ? '' : $this->Number->format($metadato->group_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Service Id') ?></th>
                    <td><?= $metadato->service_id === null ? '' : $this->Number->format($metadato->service_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($metadato->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated At') ?></th>
                    <td><?= h($metadato->updated_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deleted At') ?></th>
                    <td><?= h($metadato->deleted_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Visibility') ?></th>
                    <td><?= $metadato->visibility ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Required') ?></th>
                    <td><?= $metadato->is_required ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
