<?php 

return array( 
	
	/*
	|--------------------------------------------------------------------------
	| OAuth Config
	| Note: ${provider} will be resolved automatically
	|--------------------------------------------------------------------------
	*/

	'redirectUri' => 'https://you-callback-url.local/login/${provider}',

	/**
	 * Provider
	 */
	'provider' => array(

        /**
         * Amazon
         */
        'amazon' => array(
            'applicationId'     => '',
            'applicationSecret' => '',
            'scope'         => array()
        ),

        /**
         * Atlassian
         */
        'atlassian' => array(
            'applicationId'     => '',
            'applicationSecret' => ''
        ),

        /**
         * Bitbucket
         */
        'bitbucket' => array(
            'applicationId'     => '',
            'applicationSecret' => '',
            'scope'         => array(
                'account'
            )
        ),

        /**
         * GitHub
         */
        'github' => array(
            'applicationId'     => '',
            'applicationSecret' => '',
            'scope'         => array(
                'user',
                'email'
            ),
            'options'       => array(
                'fetch_emails'   => true
            )
        ),

        /**
         * GitLab
         */
        'gitLab' => array(
            'applicationId'     => '',
            'applicationSecret' => '',
            'scope'         => array(
                'read_user'
            )
        ),

		/**
		 * Google
		 */
        'google' => array(
            'applicationId'     => '',
            'applicationSecret' => '',
            'scope'         => array(
                'https://www.googleapis.com/auth/userinfo.email',
                'https://www.googleapis.com/auth/userinfo.profile'
            )
        ),

        /**
         * Linkedin
         */
        'linkedin' => array(
            'applicationId'     => '',
            'applicationSecret' => '',
            'scope'         => array(
                'r_liteprofile',
                'r_emailaddress'
            ),
            'options'       => array(
                'fetch_emails'  => true,
            )
        ),

		/**
		 * Slack
		 */
        'slack' => array(
            'applicationId'     => '',
            'applicationSecret' => '',
            'scope'         => array(
                'identity.basic',
                'identity.email',
                'identity.team',
                'identity.avatar'
            )
        ),

	)

);