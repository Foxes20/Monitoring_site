<?php
$router = new \core\router();
//_________________________________Admin________________________________________
$router->get('admin/feedback', [new \controllers\admin\feedback(), 'index']);
$router->get('admin/feedback_edit', [new \controllers\admin\feedback(), 'edit']);
$router->get('admin', [new \controllers\admin\start(), 'admin_view']);
$router->get('admin/monitoring_show', [new \controllers\admin\monitoring(), 'show']);
$router->get('admin/monitoring', [new \controllers\admin\monitoring(), 'index']);
$router->get('admin/monitoring_edit', [new \controllers\admin\monitoring(), 'edit']);
$router->post('admin/monitoring_delete', [new \controllers\admin\monitoring(), 'delete']);
$router->post('admin/feedback_answers', [new \controllers\admin\feedback(), 'answers']);
$router->post('admin/monitoring_update', [new \controllers\admin\monitoring(), 'update']);
$router->post('admin/feedback_delete', [new \controllers\admin\feedback(), 'delete']);
//________________________________User____________________________
$router->get('show_to_do', [new \controllers\to_do_list(), 'show_to_do']);
$router->post('write_to_do', [new \controllers\to_do_list(), 'write_to_do']);
$router->post('delete_to_do', [new \controllers\to_do_list(), 'delete_to_do']);
$router->post('update_to_do', [new \controllers\to_do_list(), 'update_to_do']);
$router->get('preparing_to_edit_to_do', [new \controllers\to_do_list(), 'preparing_to_edit_to_do']);

$router->get('new_password', [new \controllers\change_password(), 'new_password']);
$router->post('password_recovery', [new \controllers\change_password(), 'password_recovery']);
$router->get('show_password_recovery', [new \controllers\change_password(), 'show_password_recovery']);
$router->post('change_password_method', [new \controllers\change_password(), 'change_password_method']);
$router->get('showUserAccount', [new \controllers\methods_for_registration_controller(), 'showUserAccount']);
$router->post('userAccount', [new \controllers\methods_for_registration_controller(), 'userAccount']);
$router->get('show_change_password_users', [new \controllers\change_password(), 'show_change_password_users']);
$router->post('change_password_users', [new \controllers\change_password(), 'change_password_users']);
$router->get('show_registration_form', [new \controllers\methods_for_registration_controller(), 'show_registration_form']);
$router->post('register_user', [new \controllers\methods_for_registration_controller(), 'register_user']);
$router->get('login', [new controllers\methods_for_registration_controller(), 'login']);
$router->post('loginAuth', [new controllers\methods_for_registration_controller(), 'loginAuth']);
$router->get('contacts', [new \controllers\service_ip(), 'contacts']);
$router->get('service_ip', [new \controllers\service_ip(), 'index']);
$router->post('request_contacts', [new \controllers\service_ip(), 'rcontacts']);
$router->post('requests_monitoring', [new \controllers\service_ip(), 'rmonitoring']);
$router->post('requests_ip', [new \controllers\service_ip(), 'rip']);
$router->post('requests_port', [new \controllers\service_ip(), 'rport']);

$router->resolve();
