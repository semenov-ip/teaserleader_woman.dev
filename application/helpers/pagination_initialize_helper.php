<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('pagination_initialize')){

  function pagination_initialize($baseUrl, $totalRows, $perPage = 10){
    $ci =& get_instance();

    $config['base_url'] = $baseUrl;

    $config['per_page'] =  $perPage;

    $config['total_rows'] = $totalRows;

    $config['num_links'] = 2;

    $config['uri_segment'] = 4;

    $config['full_tag_open'] = '<ul class="pagination pull-right">';
    $config['full_tag_close'] = '</ul>';

    $config['first_link'] = 'В начало';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';

    $config['last_link'] = 'В конец';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';

    $config['next_link'] = '>>';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['prev_link'] = '<<';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';

    $config['cur_tag_open'] = '<li class="disabled"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';

    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';

    $ci->pagination->initialize($config);

    return $config['per_page'];
  }
}