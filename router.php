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
$router->get('contacts', [new \controllers\service_ip(), 'contacts']);
$router->get('service_ip', [new \controllers\service_ip(), 'index']);
$router->post('request_contacts', [new \controllers\service_ip(), 'rcontacts']);
$router->post('requests_monitoring', [new \controllers\service_ip(), 'rmonitoring']);
$router->post('requests_ip', [new \controllers\service_ip(), 'rip']);
$router->post('requests_port', [new \controllers\service_ip(), 'rport']);

$router->resolve();
