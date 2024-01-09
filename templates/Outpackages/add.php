<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Outpackage $outpackage
 * @var \Cake\Collection\CollectionInterface|string[] $sheets
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Liste Hors Forfaits'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="outpackages form content">
            <?= $this->Form->create($outpackage) ?>
            <fieldset>
                <legend><?= __('Nouveau Hors Forfait') ?></legend>
                <?php
                    echo $this->Form->control('date');
                    echo $this->Form->control('prix');
                    echo $this->Form->control('titre');
                    echo $this->Form->control('description');
                    echo $this->Form->control('Numéro de fiche', [
                        'options' => [$this->request->getParam('pass.0') => $this->request->getParam('pass.0')],
                        'empty' => true,
                        'value' => $this->request->getParam('pass.0')
                    ]);
                    
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
