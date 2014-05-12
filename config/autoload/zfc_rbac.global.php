<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

return [
    'zfc_rbac' => [
        'identity_provider' => 'Application\Authentication\RbacIdentityProvider',
        'guest_role' => 'guest',
        'guards' => [
            'ZfcRbac\Guard\RouteGuard' => [
                'admin-or-member' => ['admin', 'member'],
                'member-only' => ['member'],
                'admin-only' => ['admin'],
                'other-only' => ['other'],
            ]
        ],
        'protection_policy' => \ZfcRbac\Guard\GuardInterface::POLICY_ALLOW,
        'role_provider' => [
            'ZfcRbac\Role\InMemoryRoleProvider' => [
                'admin' => [
                    'children' => ['member', 'other'],
                    'permissions' => ['delete']
                ],
                'member' => [
                    'permissions' => ['read']
                ],
                'other' => [
                    'permissions' => ['edit']
                ],
            ]
        ],
        'unauthorized_strategy' => [
            'template' => 'error/403'
        ],
        /**
         * Configure the redirect strategy. It is used to redirect the user to another route when a user is
         * unauthorized
         */
        'redirect_strategy' => [
            /**
             * Enable redirection when the user is connected
             */
//            'redirect_when_connected' => true,

            /**
             * Set the route to redirect when user is connected (of course, it must exist!)
             */
//            'redirect_to_route_connected' => 'home',

            /**
             * Set the route to redirect when user is disconnected (of course, it must exist!)
             */
//            'redirect_to_route_disconnected' => 'login',

            /**
             * If a user is unauthorized and redirected to another route (login, for instance), should we
             * append the previous URI (the one that was unauthorized) in the query params?
             */
            // 'append_previous_uri' => true,

            /**
             * If append_previous_uri option is set to true, this option set the query key to use when
             * the previous uri is appended
             */
            // 'previous_uri_query_key' => 'redirectTo'
        ],
    ]
];
