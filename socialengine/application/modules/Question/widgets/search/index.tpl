<?php 
	/**
     * (amay0048) Ive added the echo base url here rather than using the javascript complie as
     * I dont have time to work out how to add these script to the global js compiler.
     * TODO: I need to come back and make is work in the correct way
     **/
?>
<?php $baseurl = Zend_Registry::get('StaticBaseUrl'); ?>
<script type="text/javascript" src="<?php echo $baseurl . 'hzsearch/POS/lexicon.js';?>"></script>
<script type="text/javascript" src="<?php echo $baseurl . 'hzsearch/POS/lexer.js';?>"></script>
<script type="text/javascript" src="<?php echo $baseurl . 'hzsearch/POS/POSTagger.js';?>"></script>
<script type="text/javascript" src="<?php echo $baseurl . 'hzsearch/search.js';?>" ></script>
<script type="text/javascript" src="<?php echo $baseurl . 'hzsearch/exclusion.js';?>" ></script>

<?php echo $this->searchform->render($this); ?>
<?php echo $this->form->render($this); ?>
<div id ='snapshotResult' class='snapshotResult'></div>
<div id ='descriptionResult' class='descriptionResult'></div>
<div id ='providersResult' class='providersResult'></div>