<?php

/**
 * Multiple Destination Route Planner for Google Maps
 * OptiMap - Fastest Roundtrip/A-Z trip Solver
 */
class Map_routing extends MX_Controller {

    var $var = '';

    function __construct() {

        parent::__construct();
        $this->load->helper('url');
        $this->page_name = $this->uri->segment(1);
        $this->load->library('CreateMap');
    }

    function index() {

        $data = array();

        $this->_display('frontend', $data);
    }

    function _display($viewname, $data) {
        $this->load->view('header');
        $this->load->view($viewname, $data);
    }

    function insert_values() {
        $duration = $_POST['pathStr'];
        $coordinates = (array) $_POST['bestPathLabelStr'];
        $this->db_interaction->insert($duration, $coordinates);
    }

}
