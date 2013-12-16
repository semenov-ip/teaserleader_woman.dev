public function log_out(){
    $this->session->sess_destroy();
    redirect( "authentication/login/", 'location' );
  }