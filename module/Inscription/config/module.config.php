<?php
return array(
    'router' => array(
        'routes' => array(
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
          
            'inscription' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/inscription',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Inscription\Controller',
                        'controller'    => 'Inscription',
                        'action'        => 'inscription',
                    ),
                ),
                'may_terminate' => true,
				'child_routes' => array(
					'default' => array(
						'type'    => 'Segment',
						'options' => array(
							'route'    => '[/:action]',
							'constraints' => array(
								'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
							)
						)
					)
				)
            ),
        ),
    ),
    'service_manager' => array(
    ),
    'controllers' => array(
        'invokables' => array(
            'Inscription\Controller\Inscription' => 'Inscription\Controller\InscriptionController',
    		'Inscription\Controller\Index' => 'Inscription\Controller\IndexController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);