<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ticket_close_admin extends CI_Controller{

  private $who, $ticketId;

  function __construct(){

    parent::__construct();

    $this->who = $this->check_users_access->checkUsers();
  }

  function index($ticketId){
    $this->load->helper('status/update_status');
    $this->load->model('update_models');

    $this->getUserId($ticketId);

    if( update_status(array('status' => 4), array( 'ticket_id' => $this->ticketId ), 'tickets') ){

      update_status(array('admin_status' => 1), array( 'ticket_id' => $this->ticketId ), 'tickets');

      redirect( "/admin/tickets_admin/", 'location'); 
    }
  }

  function getUserId($ticketId){
    $this->ticketId = $ticketId;
  }
}