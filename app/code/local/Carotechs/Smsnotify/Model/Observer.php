<?php
class Carotechs_Smsnotify_Model_Observer
{
	public function sendSmsOnOrderCreated(Varien_Event_Observer $observer)
	{
		if($this->getHelper()->isOrdersEnabled())
		{
			$orders = $observer->getEvent()->getOrderIds();
			$order = Mage::getModel('sales/order')->load($orders['0']);
			
			if ($order instanceof Mage_Sales_Model_Order)
			{
				$api_url = $this->getHelper()->getAPI();
				$message_field_name = $this->getHelper()->getMessageField();
				$to_field_name = $this->getHelper()->getToField();
				
				if($message_field_name=='')
				{
					$message_field_name = 'msg';
				}
				if($to_field_name=='')
				{
					$to_field_name = 'to';
				}
				
				$sent_method = $this->getHelper()->getSentMethod();
				
				$smsto = urlencode($this->getHelper()->getTelephoneFromOrder($order));
				$smsmsg = urlencode($this->getHelper()->getMessage($order));
							
				if($sent_method)
				{
					$data = '';
					$data .= '?'.$message_field_name.'=' . $smsmsg;
					$data .= '&'.$to_field_name.'=' . $smsto;
				
					$method = 'GET';
					$url = $api_url.$data;
					$sendSms = $this->getHelper()->sendSms($url);
				}
				else
				{
					$method = 'POST';
					$post_data[$message_field_name] = $smsmsg;
					$post_data[$to_field_name] =  $smsto;
					$url = $api_url;
					$sendSms = $this->getHelper()->sendSms($url,$post_data);
				}
				
			}
		}
	}
	
	public function sendSmsOnOrderHold(Varien_Event_Observer $observer)
	{
		if($this->getHelper()->isOrderHoldEnabled()) {
			$orders = $observer->getEvent()->getOrderIds();
			$order = Mage::getModel('sales/order')->load($orders['0']);
			
			if ($order instanceof Mage_Sales_Model_Order)
			{
				$api_url = $this->getHelper()->getAPI();
				$message_field_name = $this->getHelper()->getMessageField();
				$to_field_name = $this->getHelper()->getToField();
				
				if($message_field_name=='')
				{
					$message_field_name = 'msg';
				}
				if($to_field_name=='')
				{
					$to_field_name = 'to';
				}
				
				$sent_method = $this->getHelper()->getSentMethod();
				
				$smsto = urlencode($this->getHelper()->getTelephoneFromOrder($order));
				$smsmsg = urlencode($this->getHelper()->getSenderForOrderHold($order));
							
				if($sent_method)
				{
					$data = '';
					$data .= '?'.$message_field_name.'=' . $smsmsg;
					$data .= '&'.$to_field_name.'=' . $smsto;
				
					$method = 'GET';
					$url = $api_url.$data;
					$sendSms = $this->getHelper()->sendSms($url);
				}
				else
				{
					$method = 'POST';
					$post_data[$message_field_name] = $smsmsg;
					$post_data[$to_field_name] =  $smsto;
					$url = $api_url;
					$sendSms = $this->getHelper()->sendSms($url,$post_data);
				}
				
			}
		}
	}
	
	public function sendSmsOnOrderUnhold(Varien_Event_Observer $observer)
	{
		if($this->getHelper()->isOrderUnholdEnabled()) {
			$orders = $observer->getEvent()->getOrderIds();
			$order = Mage::getModel('sales/order')->load($orders['0']);
			
			if ($order instanceof Mage_Sales_Model_Order)
			{
				$api_url = $this->getHelper()->getAPI();
				$message_field_name = $this->getHelper()->getMessageField();
				$to_field_name = $this->getHelper()->getToField();
				
				if($message_field_name=='')
				{
					$message_field_name = 'msg';
				}
				if($to_field_name=='')
				{
					$to_field_name = 'to';
				}
				
				$sent_method = $this->getHelper()->getSentMethod();
				
				$smsto = urlencode($this->getHelper()->getTelephoneFromOrder($order));
				$smsmsg = urlencode($this->getHelper()->getSenderForOrderUnHold($order));
							
				if($sent_method)
				{
					$data = '';
					$data .= '?'.$message_field_name.'=' . $smsmsg;
					$data .= '&'.$to_field_name.'=' . $smsto;
				
					$method = 'GET';
					$url = $api_url.$data;
					$sendSms = $this->getHelper()->sendSms($url);
				}
				else
				{
					$method = 'POST';
					$post_data[$message_field_name] = $smsmsg;
					$post_data[$to_field_name] =  $smsto;
					$url = $api_url;
					$sendSms = $this->getHelper()->sendSms($url,$post_data);
				}
				
			}
		}
	}
	
	public function sendSmsOnOrderCanceled(Varien_Event_Observer $observer)
	{
		if($this->getHelper()->isOrderCanceledEnabled()) {
			$orders = $observer->getEvent()->getOrderIds();
			$order = Mage::getModel('sales/order')->load($orders['0']);
			
			if ($order instanceof Mage_Sales_Model_Order)
			{
				$api_url = $this->getHelper()->getAPI();
				$message_field_name = $this->getHelper()->getMessageField();
				$to_field_name = $this->getHelper()->getToField();
				
				if($message_field_name=='')
				{
					$message_field_name = 'msg';
				}
				if($to_field_name=='')
				{
					$to_field_name = 'to';
				}
				
				$sent_method = $this->getHelper()->getSentMethod();
				
				$smsto = urlencode($this->getHelper()->getTelephoneFromOrder($order));
				$smsmsg = urlencode($this->getHelper()->getSenderForOrderCanceled($order));
							
				if($sent_method)
				{
					$data = '';
					$data .= '?'.$message_field_name.'=' . $smsmsg;
					$data .= '&'.$to_field_name.'=' . $smsto;
				
					$method = 'GET';
					$url = $api_url.$data;
					$sendSms = $this->getHelper()->sendSms($url);
				}
				else
				{
					$method = 'POST';
					$post_data[$message_field_name] = $smsmsg;
					$post_data[$to_field_name] =  $smsto;
					$url = $api_url;
					$sendSms = $this->getHelper()->sendSms($url,$post_data);
				}
				
			}
		}
	}
	
	public function sendSmsOnShipmentCreated(Varien_Event_Observer $observer)
	{
		if($this->getHelper()->isShipmentsEnabled()) {
			$orders = $observer->getEvent()->getOrderIds();
			$order = Mage::getModel('sales/order')->load($orders['0']);
			
			if ($order instanceof Mage_Sales_Model_Order)
			{
				$api_url = $this->getHelper()->getAPI();
				$message_field_name = $this->getHelper()->getMessageField();
				$to_field_name = $this->getHelper()->getToField();
				
				if($message_field_name=='')
				{
					$message_field_name = 'msg';
				}
				if($to_field_name=='')
				{
					$to_field_name = 'to';
				}
				
				$sent_method = $this->getHelper()->getSentMethod();
				
				$smsto = urlencode($this->getHelper()->getTelephoneFromOrder($order));
				$smsmsg = urlencode($this->getHelper()->getSenderForShipment($order));
							
				if($sent_method)
				{
					$data = '';
					$data .= '?'.$message_field_name.'=' . $smsmsg;
					$data .= '&'.$to_field_name.'=' . $smsto;
				
					$method = 'GET';
					$url = $api_url.$data;
					$sendSms = $this->getHelper()->sendSms($url);
				}
				else
				{
					$method = 'POST';
					$post_data[$message_field_name] = $smsmsg;
					$post_data[$to_field_name] =  $smsto;
					$url = $api_url;
					$sendSms = $this->getHelper()->sendSms($url,$post_data);
				}
				
			}
		}
	}

	public function getHelper()
    {
        return Mage::helper('smsnotify/Data');
    }
}