<?php
class Carotechs_Smsnotify_Model_Observer
{
	public function sendSmsOnOrderCreated(Varien_Event_Observer $observer)
	{
		if($this->getHelper()->isOrdersEnabled())
		{
			$orders = $observer->getEvent()->getOrderIds();
			
			if(!empty($orders))
			{
			$order = Mage::getModel('sales/order')->load($orders['0']);
			$order_inc_id = $order->getIncrementId();
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

				/*handling error*/
				$flag = 1;
				$error_message = "Error: order create - $order_inc_id - Not able to send SMS. Make sure that your provided correct API URL,Username and Password.";
				if($api_url=='')
				{
					$flag = 0;
				}
				
				if($smsto=='')
				{
					$flag = 0;
				}
				
				if($smsmsg=='')
				{
					$flag = 0;
				}
					
				if($flag==1)
				{				
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
				else
				{
					Mage::log($error_message,null,'smsnotify.log');
				}
			}
			} // end empty 
			else
			{
				Mage::log("Error: order create - $order_inc_id - Not able to call observer. ",null,'smsnotify.log');
			}
		}
	}
	
	public function sendSmsOnOrderHold(Varien_Event_Observer $observer)
	{
		if($this->getHelper()->isOrderHoldEnabled())
		{
			$order = $observer->getOrder();
				if ($order instanceof Mage_Sales_Model_Order)
				{
				
				if ($order->getState() !== $order->getOrigData('state') && $order->getState() === Mage_Sales_Model_Order::STATE_HOLDED)
				{
				$order_inc_id = $order->getIncrementId();
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
					$smsmsg = urlencode($this->getHelper()->getMessageForOrderHold($order));

					/*handling errors*/
					$flag = 1;
					$error_message = "Error: order hold - $order_inc_id - Not able to send SMS. Make sure that your provided correct API URL,Username and Password.";
					if($api_url=='')
					{
						$flag = 0;
					}
					
					if($smsto=='')
					{
						$flag = 0;
					}
					
					if($smsmsg=='')
					{
						$flag = 0;
					}
					
							
					if($flag==1)
					{				
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
					} // end flag 
					else
					{
						Mage::log($error_message,null,'smsnotify.log');
					}
				}
				} // end state
				else
				{
					Mage::log("Error: order hold - $order_inc_id - Not able to call observer.",null,'smsnotify.log');
				}
			
		}
	}
	
	public function sendSmsOnOrderUnhold(Varien_Event_Observer $observer)
	{
		if($this->getHelper()->isOrderUnholdEnabled())
		{
			$order = $observer->getOrder();
				if ($order instanceof Mage_Sales_Model_Order)
				{
				
				if ($order->getState() !== $order->getOrigData('state') && $order->getOrigData('state') === Mage_Sales_Model_Order::STATE_HOLDED)
				{
				$order_inc_id = $order->getIncrementId();
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
					$smsmsg = urlencode($this->getHelper()->getMessageForOrderUnhold($order));
					
					/*handling errors*/
					$flag = 1;
					$error_message = "Error: order unhold - $order_inc_id - Not able to send SMS. Make sure that your provided correct API URL,Username and Password.";
					if($api_url=='')
					{
						$flag = 0;
					}
					
					if($smsto=='')
					{
						$flag = 0;
					}
					
					if($smsmsg=='')
					{
						$flag = 0;
					}
				
					if($flag==1)
					{				
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
					} // end flag 
					else
					{
						Mage::log($error_message,null,'smsnotify.log');
					}
				}
				} // end state
				else
				{
					Mage::log("Error: order unhold - $order_inc_id - Not able to call observer.",null,'smsnotify.log');
				}
			
		}
	}
	
	public function sendSmsOnOrderCanceled(Varien_Event_Observer $observer)
	{
		if($this->getHelper()->isOrderCanceledEnabled())
		{
				$order = $observer->getOrder();
				if ($order instanceof Mage_Sales_Model_Order)
				{
				if ($order->getState() !== $order->getOrigData('state') && $order->getState() === Mage_Sales_Model_Order::STATE_CANCELED)
				{
				$order_inc_id = $order->getIncrementId();
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
					$smsmsg = urlencode($this->getHelper()->getMessageForOrderCanceled($order));
							
							
					/*handling errors*/
					$flag = 1;
					$error_message = "Error: order cancel - $order_inc_id - Not able to send SMS. Make sure that your provided correct API URL,Username and Password.";
					if($api_url=='')
					{
						$flag = 0;
					}
					
					if($smsto=='')
					{
						$flag = 0;
					}
					
					if($smsmsg=='')
					{
						$flag = 0;
					}
					
					
					if($flag==1)
					{				
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
					} // end flag 
					else
					{
						Mage::log($error_message,null,'smsnotify.log');
					}
				}
				} // end state
				else
				{
					Mage::log("Error: order cancel - $order_inc_id - Not able to call observer.",null,'smsnotify.log');
				}
			
		}
	}
	
	public function sendSmsOnShipmentCreated(Varien_Event_Observer $observer)
	{
		if($this->getHelper()->isShipmentsEnabled())
		{
				$shipment = $observer->getEvent()->getShipment();
				$order = $shipment->getOrder();
				
				if ($order instanceof Mage_Sales_Model_Order)
				{
				$order_inc_id = $order->getIncrementId();
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
					$smsmsg = urlencode($this->getHelper()->getMessageForShipment($order));

					/*handling errors*/
					$flag = 1;
					$error_message = "Error: order shipment - $order_inc_id - Not able to send SMS. Make sure that your provided correct API URL,Username and Password.";
	
					if($api_url=='')
					{
						$flag = 0;
					}
					
					if($smsto=='')
					{
						$flag = 0;
					}
					
					if($smsmsg=='')
					{
						$flag = 0;
					}

					if($flag==1)
					{				
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
					} // end flag 
					else
					{
						Mage::log($error_message,null,'smsnotify.log');
					}
				
				} // end state
				else
				{
					Mage::log("Error: order shipment - $order_inc_id - Not able to call observer.",null,'smsnotify.log');
				}
			
		}
	}

	public function getHelper()
    {
        return Mage::helper('smsnotify/Data');
    }
}