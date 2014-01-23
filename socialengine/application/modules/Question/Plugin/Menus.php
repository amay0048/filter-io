<?php
class Questions_Plugin_Menus
{
  // core_mini
  
  public function canViewCars()
  {
    $viewer = Engine_Api::_()->user()->getViewer();
    // Check auth
    return (bool) Engine_Api::_()->authorization()->isAllowed('car', $viewer, 'view');
  }
  
}
