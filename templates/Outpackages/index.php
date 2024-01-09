<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Outpackage> $outpackages
 */
?>
<div class="outpackages index content">
    <?= $this->Html->link(__('Nouveau Hors Forfait'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Hors Forfaits') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('date') ?></th>
                    <th><?= $this->Paginator->sort('Prix') ?></th>
                    <th><?= $this->Paginator->sort('Titre') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($outpackages as $outpackage): ?>
                <tr>
                    <td><?= $this->Number->format($outpackage->id) ?></td>
                    <td><?= h($outpackage->date) ?></td>
                    <td><?= $this->Number->format($outpackage->price) ?>€</td>
                    <td><?= h($outpackage->title) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Voir'), ['action' => 'view', $outpackage->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $outpackage->id]) ?>
                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $outpackage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $outpackage->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('Premiére')) ?>
            <?= $this->Paginator->prev('< ' . __('Précédente')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('Suivante') . ' >') ?>
            <?= $this->Paginator->last(__('Derniére') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
