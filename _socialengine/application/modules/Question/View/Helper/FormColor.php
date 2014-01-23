<?php

class Question_View_Helper_FormColor extends Zend_View_Helper_FormElement
{

  public function formColor($name, $value = null, $attribs = null,
      $options = null, $listsep = "
\n")
  {
    $info = $this->_getInfo($name, $value, $attribs, $options, $listsep);
    extract($info); // name, value, attribs, options, listsep, disable
    $cellWidth = empty($attribs['cellWidth']) ? 8 : $attribs['cellWidth'];
    unset($attribs['cellWidth']);
    $cellHeight = empty($attribs['cellHeight']) ? 12 : $attribs['cellHeight'];
    unset($attribs['cellHeight']);
    $this->view->headScript()->appendFile($this->view->layout()->staticBaseUrl
      . 'application/modules/Question/externals/scripts/color-picker.js');
    return $this->view->formText($name, $value, $attribs, $options)
      . $this->view->inlineScript()->appendScript(
        sprintf("new ColorPicker($('%s'), {cellWidth: %d, cellHeight: %d})",
          $name, $cellWidth, $cellHeight));
  }
}




