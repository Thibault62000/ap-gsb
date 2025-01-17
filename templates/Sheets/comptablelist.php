<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Sheet> $sheets
 * 
 * 
 * <th><?= $this->Paginator->sort('user_id') ?></th>
 * $sheet->has('user') ? $this->Html->link($sheet->user->username, ['controller' => 'Users', 'action' => 'view', $sheet->user->id]) : ''
 */


$identity = $this->getRequest()->getAttribute('identity');
$identity = $identity ?? [];
$iduser = $identity["id"]

?>
<div class="sheets index content">
<div class="float-left" style="padding: 10px 20px;">Bonjour <strong><?php if(empty($identity["first_name"]) && empty($identity["last_name"])){echo $identity["username"];}elseif(empty($identity["first_name"])){echo 'Mr. '.$identity["last_name"];}else{echo $identity["first_name"];} ?></strong>, vous pouvez désormais consulter la fiche client : </div>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                    <th><?= $this->Paginator->sort('state_id', 'Etat') ?></th>
                    <th><?= $this->Paginator->sort('created', 'Créé') ?></th>
                    <th><?= $this->Paginator->sort('modified', 'Modifié') ?></th>
                    <th class="display-flex"><?= $this->Paginator->sort('sheetvalidated', 'Validation') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sheets as $sheet): ?>
                    <tr>
                        <td><?= $this->Number->format($sheet->id) ?></td>
                        <td><?php
                        if($sheet->state->id == 1){
                            echo "<span style='color: #3498db'>".$sheet->state->state."</span>";
                        }elseif($sheet->state->id == 2){
                            echo "<span style='color: #e74c3c'>".$sheet->state->state."</span>";
                        }elseif($sheet->state->id == 3){
                            echo "<span style='color: #2ecc71'>".$sheet->state->state."</span>";
                        }elseif($sheet->state->id == 4){
                            echo "<span style='color: #f39c12'>".$sheet->state->state."</span>";
                        }elseif($sheet->state->id == 5){
                            echo "<span style='color: #27ae60'>".$sheet->state->state."</span>";
                        }else{
                            echo "N/A";
                        }
        
                         ?></td>
                        <td><?= h($sheet->created) ?></td>
                        <td><?= h($sheet->modified) ?></td>
                        <td class="display-flex"><?php if($sheet->sheetvalidated == 1){echo "<div class='tag success'>Validé</div>";}else{echo "<div class='tag error'>Non validé</div>";} ?></td>
                        <td class="actions">
                            <?php if($sheet->state->id > 1){echo $this->Html->link(__('Voir'), ['action' => 'comptableview', $sheet->id]);}elseif($sheet->state->id == 1){echo $this->Html->link(__('View'), ['action' => 'clientview', $sheet->id]);}else{echo $this->Html->link(__('Edit'), ['action' => 'clientview', $sheet->id]);}  ?>
                            
                            <!-- $this->Form->postLink(__('Delete'), ['action' => 'delete', $sheet->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sheet->id)]) -->
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('premiére')) ?>
            <?= $this->Paginator->prev('< ' . __('précédente')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('suivante') . ' >') ?>
            <?= $this->Paginator->last(__('derniér') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} sur {{pages}}, affichage {{current}} enregistrement(s) enregistrement(s) sur {{count}} au total  ')) ?></p>
    </div>
</div>