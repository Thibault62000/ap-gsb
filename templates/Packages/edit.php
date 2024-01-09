<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Package $package
 * @var string[]|\Cake\Collection\CollectionInterface $sheets
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'Supprimer', $package->id],
                ['confirm' => __('Êtes-vous sûr de vouloir cette fiche qui a pour numéro # {0}?', $package->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('Listes Packages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="packages form content">
            <?= $this->Form->create($package) ?>
            <fieldset>
                <legend><?= __('Edit Package') ?></legend>
                <?php
                    echo $this->Form->control('Prix');
                    echo $this->Form->control('Titre');
                    echo $this->Form->control('Description');
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
