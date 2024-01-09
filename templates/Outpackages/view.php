<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Outpackage $outpackage
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edite Hors Forfait'), ['action' => 'edit', $outpackage->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Supprimer Hors Forfait'), ['action' => 'delete', $outpackage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $outpackage->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Liste Hors Forfait'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Nouveau Hors Forfait'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="outpackages view content">
            <h3><?= h($outpackage->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Titre') ?></th>
                    <td><?= h($outpackage->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($outpackage->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Prix') ?></th>
                    <td><?= $this->Number->format($outpackage->price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date') ?></th>
                    <td><?= h($outpackage->date) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($outpackage->body)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Sheets') ?></h4>
                <?php if (!empty($outpackage->sheets)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Id utilisateur') ?></th>
                            <th><?= __('Etat Id') ?></th>
                            <th><?= __('FicheValider') ?></th>
                            <th><?= __('Créer') ?></th>
                            <th><?= __('Modifier') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($outpackage->sheets as $sheets) : ?>
                        <tr>
                            <td><?= h($sheets->id) ?></td>
                            <td><?= h($sheets->user_id) ?></td>
                            <td><?= h($sheets->state_id) ?></td>
                            <td><?= h($sheets->sheetvalidated) ?></td>
                            <td><?= h($sheets->created) ?></td>
                            <td><?= h($sheets->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('Voir'), ['controller' => 'Sheets', 'action' => 'view', $sheets->id]) ?>
                                <?= $this->Html->link(__('Edits'), ['controller' => 'Sheets', 'action' => 'edit', $sheets->id]) ?>
                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Sheets', 'action' => 'delete', $sheets->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sheets->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
