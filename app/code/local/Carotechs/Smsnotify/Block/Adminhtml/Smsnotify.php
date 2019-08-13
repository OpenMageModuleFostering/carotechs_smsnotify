<?php
class Carotechs_Smsnotify_Block_Adminhtml_Smsnotify extends Mage_Adminhtml_Block_Template
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_smsnotify';
    $this->setFormAction(Mage::getUrl('*/*/sendsms'));
    $this->_headerText = Mage::helper('smsnotify')->__('Send SMS');
  
  }

}