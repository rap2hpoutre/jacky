<?php
return [
    
    /**
     * You can declare as much servers you want. Here is an example 
     * on `default` server, you may override or delete it.
     */
    'servers' => [
        
        /**
         * This is the default server for example purpose.
         */
        'default' => [
            
            /**
             * Base URI of the endpoint. Ex: https://api.twitter.com/1.1
             */
            'base_uri' => '',
            
            /**
             * Auth method. Only basic auth is available now.
             */
            'auth_method' => 'basic',
            
            /**
             * Auth method parameters
             */
            'auth' => [
                
                /**
                 * Basic Auth parameters.
                 */
                'basic' => [
                    'username' => '',
                    'password' => '',
                ],
                'oauth' => [] // Not implemented yet    
            ],
            
            /**
             * Accessors may help you on response post process.
             * Assuming you always have a data field in responses
             * and you want to access it via collection, you can set
             * data field to collect (or any other callback function)
             */
            'accessors' => [
                'data' => 'collect' // Callback function
            ]
        ]
    ],
    
    /**
     * You may want to log everything.
     */
    'debug' => false
];
