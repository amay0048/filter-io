
<h2><?php echo $this->translate("PAGEDISCUSSION_PLUGIN")?></h2>

<?php if( count($this->navigation) ): ?>
  <div class='page_admin_tabs'>
    <?php
      // Render the menu
      //->setUlClass()
      echo $this->navigation()->menu()->setContainer($this->navigation)->render();
    ?>
  </div>
<?php endif; ?>

<div class="settings">
    <?php echo $this->form->render()?>
    <?php echo $this->content()->renderWidget('page.admin-settings-menu',array('active_item'=>'page_admin_main_discussion')); ?>
</div>