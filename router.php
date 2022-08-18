<?php

$router = new \core\router();

$router->get('service_ip', [new \controllers\service_ip(), 'run']);
$router->get('contacts', [new \controllers\contacts(), 'run']);
$router->get('admin/feedback_edit', [new \controllers\admin\feedback_edit(), 'run']);
$router->get('admin/monitoring_edit', [new \controllers\admin\monitoring_edit(), 'run']);
$router->get('admin/monitoring_save', [new \controllers\admin\monitoring_save(), 'run']);
$router->get('admin/monitoring_show', [new \controllers\admin\monitoring_show(), 'run']);
$router->get('admin/feedback', [new \controllers\admin\feedback(), 'run']);

$router->post('requests_port', [new \controllers\requests_port(), 'run']);
$router->post('requests_monitoring', [new \controllers\requests_monitoring(), 'run']);
$router->post('requests_ip', [new \controllers\requests_ip(), 'run']);
$router->post('request_contacts', [new \controllers\request_contacts(), 'run']);
$router->post('admin/monitoring_delete', [new \controllers\admin\monitoring_delete(), 'run']);
$router->post('admin/monitoring_upd', [new \controllers\admin\monitoring_upd(), 'run']);
$router->post('admin/feedback_delete', [new \controllers\admin\feedback_delete(), 'run']);
$router->post('admin/feedback_answers', [new \controllers\admin\feedback_answers(), 'run']);

$router->resolve();
