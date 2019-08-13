<?php

class Carotechs_Smsnotify_Adminhtml_SmsnotifyController extends Mage_Adminhtml_Controller_action
{

	protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('customer/customer')
			->_addBreadcrumb(Mage::helper('smsnotify')->__('Items Manager'), Mage::helper('smsnotify')->__('Item Manager'));
		
		return $this;
	}   
 
	public function indexAction() {
	
		$this->_initAction();
		$this->loadLayout()
			->_setActiveMenu('customer/customer')
			->renderLayout();
	}

	public function sendsmsAction()
	{
		extract($_POST);
		if(isset($_POST))
		{
		$phone_array = explode(',',$phone_numbers);
		//Gateway credentials  
					
				$api_url = Mage::helper('smsnotify')->getAPI();
				$message_field_name = Mage::helper('smsnotify')->getMessageField();
				$to_field_name = Mage::helper('smsnotify')->getToField();
				
				if($message_field_name=='')
				{
					$message_field_name = 'msg';
				}
				if($to_field_name=='')
				{
					$to_field_name = 'to';
				}
				$sent_method = Mage::helper('smsnotify')->getSentMethod();
		

				/*handling error*/
				$flag = 1;
				$error_message = "Error: Send SMS - Not able to send SMS. Make sure that your provided correct API URL,Username and Password.";
				if($api_url=='')
				{
					$flag = 0;
				}

					
				if($flag==1)
				{			
					for($i=0;$i<count($phone_array);$i++)
					{
						if($phone_array[$i]!='')
						{
							if($sent_method)
							{
								$data = '';
								$data .= '?'.$message_field_name.'=' . $message;
								$data .= '&'.$to_field_name.'=' . $phone_array[$i];
							
								$method = 'GET';
								$url = $api_url.$data;
								$sendSms = Mage::helper('smsnotify')->sendSms($url);
							}
							else
							{
								$post_data = array();
								$post_data[$message_field_name] = $message;
								$post_data[$to_field_name] =  $phone_array[$i];
								$url = $api_url;
								$sendSms = Mage::helper('smsnotify')->sendSms($url,$post_data);
							}
						}
					}
					Mage::getSingleton('core/session')->setSmsstatus('success');
					Mage::getSingleton('core/session')->setSmsmsg('Message sent successfully.');
					$this->_redirect('*/*/');
				}
				else
				{
					Mage::log($error_message,null,'smsnotify.log');
				}

		
		}
		else
		{
			Mage::getSingleton('core/session')->setSmsstatus('error');
			Mage::getSingleton('core/session')->setSmsmsg('Unable to send SMS.');
			$this->_redirect('*/*/');
		}
		
		$this->loadLayout();
		$this->renderLayout();
	}	
}