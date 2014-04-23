<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Ticket_close extends CI_Controller{

  private $who, $ticketId;

  function __construct(){

    parent::__construct();

    $this->who = $this->check_users_access->checkUsers();
  }

  function index($ticketId){
    $this->load->helper('status/update_status');
    $this->load->model('update_models');

    $this->getUserId($ticketId);

    if(update_status(array('status' => 3), array( 'ticket_id' => $this->ticketId ), 'tickets')){

      update_status(array('admin_status' => 1), array( 'ticket_id' => $this->ticketId ), 'tickets');

      redirect( "/_shared/tickets/", 'location');
    }
  }

  function getUserId($ticketId){
    $this->ticketId = $ticketId;
  }
}