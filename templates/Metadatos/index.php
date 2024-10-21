<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Metadato> $metadatos
 */
?>
<div class="metadatos index content">
    <?= $this->Html->link(__('New Metadato'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Metadatos') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('label') ?></th>
                    <th><?= $this->Paginator->sort('group_id') ?></th>
                    <th><?= $this->Paginator->sort('service_id') ?></th>
                    <th><?= $this->Paginator->sort('tag') ?></th>
                    <th><?= $this->Paginator->sort('selectData') ?></th>
                    <th><?= $this->Paginator->sort('visibility') ?></th>
                    <th><?= $this->Paginator->sort('is_required') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('updated_at') ?></th>
                    <th><?= $this->Paginator->sort('deleted_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($metadatos as $metadato): ?>
                <tr>
                    <td><?= $this->Number->format($metadato->id) ?></td>
                    <td><?= h($metadato->name) ?></td>
                    <td><?= h($metadato->label) ?></td>
                    <td><?= $metadato->group_id === null ? '' : $this->Number->format($metadato->group_id) ?></td>
                    <td><?= $metadato->service_id === null ? '' : $this->Number->format($metadato->service_id) ?></td>
                    <td><?= h($metadato->tag) ?></td>
                    <td><?= h($metadato->selectData) ?></td>
                    <td><?= h($metadato->visibility) ?></td>
                    <td><?= h($metadato->is_required) ?></td>
                    <td><?= h($metadato->created_at) ?></td>
                    <td><?= h($metadato->updated_at) ?></td>
                    <td><?= h($metadato->deleted_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $metadato->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $metadato->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $metadato->id], ['confirm' => __('Are you sure you want to delete # {0}?', $metadato->id)]) ?>
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

    <?php if (!empty($data)): ?>
        <!-- Mostrar la tabla de resultados -->
        <table>
            <thead>
                <tr>
                    <?php
                    // Obtener los nombres de los atributos desde el primer elemento del array
                    $firstRow = $data[0];
                    foreach ($firstRow as $column => $value): ?>
                        <th><?= h(ucfirst($column)) ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <?php foreach ($row as $value): ?>
                            <td><?= h($value) ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay datos disponibles.</p>
    <?php endif; ?>

</div>
