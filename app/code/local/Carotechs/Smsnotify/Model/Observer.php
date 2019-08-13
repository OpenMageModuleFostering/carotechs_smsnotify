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
				if($message_field_name=='')
				{
					$message_field_name = 'message';
				}
				$sent_method = $this->getHelper()->getSentMethod();
				
				$smsto = $this->getHelper()->getTelephoneFromOrder($order);
				$smsmsg = $this->getHelper()->getMessage($order);
							
				
				$data .= '&'.$message_field_name.'=' . urlencode($smsmsg);
				$api_url = str_replace('{{mobile_no}}',$smsto,$api_url);
				
				if($sent_method)
				{
					$method = 'GET';
					$url = $api_url.$data;
					$sendSms = $this->getHelper()->sendSms($url);
				}
				else
				{
					$method = 'POST';
					$url = $api_url;
					$sendSms = $this->getHelper()->sendSms($url,$data);
				}
				
			}
		}
	}
	
	public function sendSmsOnOrderHold(Varien_Event_Observer $observer)
	{
		if($this->getHelper()->isOrderHoldEnabled()) {
			$order = $observer->getOrder();
			if ($order instanceof Mage_Sales_Model_Order) {
				if ($order->getState() !== $order->getOrigData('state') && $order->getState() === Mage_Sales_Model_Order::STATE_HOLDED)
				{
				$api_url = $this->getHelper()->getAPI();
				$message_field_name = $this->getHelper()->getMessageField();
				if($message_field_name=='')
				{
					$message_field_name = 'message';
				}
				$sent_method = $this->getHelper()->getSentMethod();
				
				$smsto = $this->getHelper()->getTelephoneFromOrder($order);
				$smsmsg = $this->getHelper()->getMessageForOrderHold($order);
							
				
				$data .= '&'.$message_field_name.'=' . urlencode($smsmsg);
				$api_url = str_replace('{{mobile_no}}',$smsto,$api_url);
				
				if($sent_method)
				{
					$method = 'GET';
					$url = $api_url.$data;
					$sendSms = $this->getHelper()->sendSms($url);
				}
				else
				{
					$method = 'POST';
					$url = $api_url;
					$sendSms = $this->getHelper()->sendSms($url,$data);
				}
				

				}
			}
		}
	}
	
	public function sendSmsOnOrderUnhold(Varien_Event_Observer $observer)
	{
		if($this->getHelper()->isOrderUnholdEnabled()) {
			$order = $observer->getOrder();
			if ($order instanceof Mage_Sales_Model_Order) {
				if ($order->getState() !== $order->getOrigData('state') && $order->getOrigData('state') === Mage_Sales_Model_Order::STATE_HOLDED)
				{
				$api_url = $this->getHelper()->getAPI();
				$message_field_name = $this->getHelper()->getMessageField();
				if($message_field_name=='')
				{
					$message_field_name = 'message';
				}
				$sent_method = $this->getHelper()->getSentMethod();
				
				$smsto = $this->getHelper()->getTelephoneFromOrder($order);
				$smsmsg = $this->getHelper()->getMessageForOrderUnhold($order);
							
				
				$data .= '&'.$message_field_name.'=' . urlencode($smsmsg);
				$api_url = str_replace('{{mobile_no}}',$smsto,$api_url);
				
				if($sent_method)
				{
					$method = 'GET';
					$url = $api_url.$data;
					$sendSms = $this->getHelper()->sendSms($url);
				}
				else
				{
					$method = 'POST';
					$url = $api_url;
					$sendSms = $this->getHelper()->sendSms($url,$data);
				}
				
				}
			}
		}
	}
	
	public function sendSmsOnOrderCanceled(Varien_Event_Observer $observer)
	{
		if($this->getHelper()->isOrderCanceledEnabled()) {
			$order = $observer->getOrder();
			if ($order instanceof Mage_Sales_Model_Order) {
				if ($order->getState() !== $order->getOrigData('state') && $order->getState() === Mage_Sales_Model_Order::STATE_CANCELED)
				{
				$api_url = $this->getHelper()->getAPI();
				$message_field_name = $this->getHelper()->getMessageField();
				if($message_field_name=='')
				{
					$message_field_name = 'message';
				}
				$sent_method = $this->getHelper()->getSentMethod();
				
				$smsto = $this->getHelper()->getTelephoneFromOrder($order);
				$smsmsg = $this->getHelper()->getMessageForOrderCanceled($order);
							
				
				$data .= '&'.$message_field_name.'=' . urlencode($smsmsg);
				$api_url = str_replace('{{mobile_no}}',$smsto,$api_url);
				
				if($sent_method)
				{
					$method = 'GET';
					$url = $api_url.$data;
					$sendSms = $this->getHelper()->sendSms($url);
				}
				else
				{
					$method = 'POST';
					$url = $api_url;
					$sendSms = $this->getHelper()->sendSms($url,$data);
				}
				
				}
			}
		}
	}
	
	public function sendSmsOnShipmentCreated(Varien_Event_Observer $observer)
	{
		if($this->getHelper()->isShipmentsEnabled()) {
			$shipment = $observer->getEvent()->getShipment();
			$order = $shipment->getOrder();
			if ($order instanceof Mage_Sales_Model_Order)
			{
				$api_url = $this->getHelper()->getAPI();
				$message_field_name = $this->getHelper()->getMessageField();
				if($message_field_name=='')
				{
					$message_field_name = 'message';
				}
				$sent_method = $this->getHelper()->getSentMethod();
				
				$smsto = $this->getHelper()->getTelephoneFromOrder($order);
				$smsmsg = $this->getHelper()->getMessageForShipment($order);
							
				
				$data .= '&'.$message_field_name.'=' . urlencode($smsmsg);
				$api_url = str_replace('{{mobile_no}}',$smsto,$api_url);
				
				if($sent_method)
				{
					$method = 'GET';
					$url = $api_url.$data;
					$sendSms = $this->getHelper()->sendSms($url);
				}
				else
				{
					$method = 'POST';
					$url = $api_url;
					$sendSms = $this->getHelper()->sendSms($url,$data);
				}
				
			}
		}
	}

	public function getHelper()
    {
        return Mage::helper('smsnotify/Data');
    }
}