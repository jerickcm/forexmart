<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function current_full_url() {
    $ci =& get_instance();
    $url = $ci->config->site_url($ci->uri->uri_string());
    return $_SERVER['QUERY_STRING'] ? $url.'?'.$_SERVER['QUERY_STRING'] : $url;
}

/* End of file MY_url_helper.php */
/* Location: ./application/helpers/MY_url_helper.php */