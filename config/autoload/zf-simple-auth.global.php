<?php
return array(
    'zf-simple-auth' => array(
        'users' => array(
            'demo-admin' => array(
                'password' => 'foobar',
                'roles' => array(
                    'admin',
                    'member',
                )
            ),
            'demo-member' => array(
                'password' => 'foobar',
                'roles' => array(
                    'member',
                )
            ),
            'demo-other' => array(
                'password' => 'foobar',
                'roles' => array(
                    'other',
                )
            ),
        ),
    ),
);
