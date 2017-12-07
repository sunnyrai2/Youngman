<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
	 /**
     * Sends notifications when a new order is made to both
     * planning and customer and account manager, RM, SD
     */
    public function notifyNewOrder()
    {
      
   	}


	 /**
     * Sends a notification to Godown Manager
     * of new movement in dashboard
     */
    public function notifyNewMovement()
    {
      
   	}


	 /**
     * Sends a notification to planning and finance
     *	that the material has been picked up by from the customer
     */
    public function notifyNewPickupRecieving()
    {
      
   	}


	 /**
     * Sends a notification to finance and planning
     * that material has been delivered to customer
     */
    public function notifyNewDeliveryRecieving()
    {
      
   	}


	 /**
     * Sends notifiaction to Sales coordinator
     * and customer that pickup is due
     */
    public function notifyNewPickupDate()
    {
      
   	}


	 /**
     * Sends notification to customer and sales coordinator 
     * that pickup has been extended
     */
    public function notifyNewPickupDateExtended()
    {
      
   	}


	 /**
     * Sends a notification to admin and planning that 
     *planning of some orders are pending
     */
    public function notifyPendingPlanning()
    {
      
   	}


	 /**
     * Sends a notification to admin and godown manager that 
     * and logistic head that movement of some challans are pending
     */
    public function notifyPendingMovement()
    {
      
   	}
}
