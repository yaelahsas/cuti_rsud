<?php
function check_login()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('user');
    if ($user_session) {
        redirect('Admin');
    }
}
function check_not_login()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('user');
    if (!$user_session) { 
        redirect('Auth');
    }
}

function check_admin()
{
    $ci = &get_instance();
    $ci->load->library('fungsi');
    if ($ci->fungsi->user_login()->level == 3) {
        redirect('Artikel');
    }
}


function check_admin_1()
{
    $ci = &get_instance();
    $ci->load->library('fungsi');
    if ($ci->fungsi->user_login()->level != 1) {
        redirect('Artikel');
    }
}
