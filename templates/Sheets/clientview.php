<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sheet $sheet
 */

 $identity = $this->getRequest()->getAttribute('identity');
$identity = $identity ?? [];
$iduser = $identity["id"];

$total = 0;
$total_package = 0;
$total_outpackage = 0;
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?php if ($sheet->state->id == 1 && !$sheet->sheetvalidated): ?>
                <?= $this->Form->postLink(__('Delete Sheet'), ['action' => 'delete', $sheet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sheet->id), 'class' => 'side-nav-item']) ?>
            <?php endif; ?>
            <?= $this->Html->link(__('List Sheets'), ['action' => 'list'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="sheets view content">
            <h3><?= h($sheet->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nom') ?></th>
                    <td><?= $sheet->user->last_name ?></td>
                </tr>
                <tr>
                    <th><?= __('Prénom') ?></th>
                    <td><?= $sheet->user->first_name ?></td>
                </tr>
                <tr>
                    <th><?= __('Statue') ?></th>
                    <td><?= $sheet->state->state ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($sheet->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Créer') ?></th>
                    <td><?= h($sheet->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modifier') ?></th>
                    <td><?= h($sheet->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fiche valider') ?></th>
                    <td><?= $sheet->sheetvalidated ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            
            <div class="related">
                <h4 class="float-left"><?= __('Related Packages') ?></h4>
                <?= $this->Form->create($sheet, ['url' => ['controller' => 'Sheets', 'action' => 'clientview', $sheet->id]]) ?>
                <?php if (!empty($sheet->packages)) : ?>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <th><?= __('Id') ?></th>
                                
                                
                                <th><?= __('Titre') ?></th>
                                <th><?= __('Description') ?></th>
                                <th><?= __('Quantitée') ?></th>
                                <th><?= __('Prix') ?></th>
                            </tr>
                            <?php foreach ($sheet->packages as $package) : ?>
                                <tr>
                                    <td><?= h($package->id) ?></td>
                                    
                                    
                                    <td><?= h($package->title) ?></td>
                                    <!-- Limiter la taille du champ body à 100 caractères -->
                                    <td title="<?= h($package->body) ?>">
                                        <?= h(substr($package->body, 0, 100)) ?> ...
                                    </td>
                                    <?php if ($sheet->state->id == 1 && !$sheet->sheetvalidated): ?>
                                        <td style="display: none">
                                            <?= $this->Form->postLink(__('None')) ?>
                                        </td>
                                    <?php endif; ?>
                                    <?php if ($sheet->state->id == 1 && !$sheet->sheetvalidated): ?>
                                        <td>
                                            <?= $this->Form->hidden("packages.{$package->id}.id", ['value' => $package->_joinData->id]) ?>
                                            <?= $this->Form->control("packages.{$package->id}.quantity", ['type' => 'text', 'label' => false, 'value' => isset($package->_joinData->quantity) ? $package->_joinData->quantity : 0]) ?>
                                        </td>
                                    <?php else: ?>
                                        <td><?php echo $package->_joinData->quantity ?></td>
                                    <?php endif; ?>
                                    <td><?= h($package->price) ?> €</td>
                                </tr>
                                <?php $total_package += ($package->_joinData->quantity * $package->price) ?>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <div style="margin-top: 1rem;">
                        <?php if ($sheet->state->id == 1 && !$sheet->sheetvalidated): ?>
                            <td>
                                <?= $this->Form->hidden('action', ['value' => '']) ?>
                                <?= $this->Form->button('Enregistrer', ['type' => 'submit']) ?>
                            </td> 
                        <?php endif; ?>
                        <?= '<strong style="margin-left: 1rem">Total package : </strong>'.$total_package." €" ?>
                    </div>
                <?php endif; ?>
                <?= $this->Form->end() ?>
                
            </div>
            <div class="related">
                <h4 class="float-left"><?= __('Relier Hors Forfait') ?></h4>
                <?php if($sheet->state->id == 1): ?>
                    <?php if($sheet->sheetvalidated == false): ?>
                        <?= $this->Html->link('Nouveau Hors Forfait', ['controller' => 'Outpackages', 'action' => 'add', $sheet->id], ['class' => 'button float-right']) ?>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if (!empty($sheet->outpackages)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Titre') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Prix') ?></th>
                            <?php if($sheet->state->id == 1): ?>
                                <?php if($sheet->sheetvalidated == false): ?>
                                    <th class="actions"><?= __('Actions') ?></th>
                                <?php endif; ?>
                            <?php endif; ?>
                        </tr>
                        <?php foreach ($sheet->outpackages as $outpackages) : ?>
                        <tr>
                            <td><?= h($outpackages->id) ?></td>
                            <td><?= h($outpackages->price) ?> €</td>
                            <td><?= h($outpackages->title) ?></td>
                            <!-- Limiter la taille du champ body à 100 caractères -->
                            <td title="<?= h($outpackages->body) ?>">
                                <?= h(substr($outpackages->body, 0, 100)) ?> ...
                            </td>
                            <?php if($sheet->state->id == 1): ?>
                                <?php if($sheet->sheetvalidated == false): ?>
                                    <td class="actions">
                                        <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Outpackages', 'action' => 'delete', $outpackages->id, $sheet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $outpackages->id)]) ?>
                                    </td>
                                <?php endif; ?>
                            <?php endif; ?>
                        </tr>
                        <?php $total_outpackage = $total_outpackage + $outpackages->price; ?>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
                <?= '<div style="margin-top: 1rem"><strong>Total outpackage : </strong>'.$total_outpackage." €</div>" ?>
                <?= '</br><strong>Total : </strong>'.$total = $total_outpackage + $total_package." €" ?>
            </div>
            
        </div>
    </div>
</div>