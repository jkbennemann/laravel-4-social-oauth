# OAuth wrapper for Laravel 4

oauth-laravel-4 is a simple laravel 4 service provider for [socialconnect/auth](https://github.com/SocialConnect/auth) 
which provides OAuth support for PHP 5.3+ and is very easy to integrate with any project which requires an OAuth client.

## Supported services

The library supports OAuth 1.x and OAuth 2.0 compliant services.
A list of currently implemented services can be found [on their site](https://socialconnect.lowl.io/providers.html).
Some examples are listed below:

Included service implementations:

- Steam	OpenID	 
- Atlassian	OAuth1	 
- 500px	OAuth1	 
- Trello	OAuth1	 
- Tumblr	OAuth1	 
- Twitter	OAuth1	 
- Amazon	OAuth2	 
- Facebook	OAuth2	3.3
- Vk (ВКонтакте)	OAuth2	5.100
- Instagram	OAuth2	 
- Google	OAuth2	 
- GitHub	OAuth2	 
- GitLab	OAuth2	 
- Slack	OAuth2	 
- BitBucket	OAuth2	 
- Twitch	OAuth2	 
- Vimeo	OAuth2	 
- DigitalOcean	OAuth2	 
- Yandex	OAuth2	 
- MailRu	OAuth2	 
- Microsoft (MSN)	OAuth2	 
- Meetup	OAuth2	 
- Odnoklassniki	OAuth2	 
- Discord	OAuth2	 
- SmashCast	OAuth2	 
- Steein	OAuth2	 
- LinkedIn	OAuth2	 
- Yahoo!	OAuth2	 
- Wordpress	OAuth2	 
- Google	OpenIDConnect	 
- PixelIn	OpenIDConnect	 
- more to come!

To learn more about SocialConnect/auth go [here](https://github.com/SocialConnect/auth) 

## Installation

Use [composer](http://getcomposer.org) to install this package.

```
$ composer require jkbennemann/oauth-laravel-4
```

### Registering the Package

Register the service provider within the ```providers``` array found in ```app/config/app.php```:

```php
'providers' => array(
	// ...
	
	'Jkbennemann\OAuth\OAuthServiceProvider',
)
```

Add an alias within the ```aliases``` array found in ```app/config/app.php```:


```php
'aliases' => array(
	// ...
	
	'OAuth' => 'Jkbennemann\OAuth\Facade\OAuth',
)
```

## Configuration

There are two ways to configure oauth-4-laravel.
You can choose the most convenient way for you. 
You can use package config file which can be 
generated through command line by artisan (option 1) or 
you can simply create a config file called ``laravel-4-social-oauth.php`` in 
your ``app\config\`` directory (option 2).

#### Option 1

Create configuration file for package using artisan command

```
$ php artisan config:publish jkbennemann/laravel-4-social-oauth
```

#### Option 2

Create configuration file manually in config directory ``app/config/laravel-4-social-oauth.php`` and put there code from below.

```php
<?php 

return array( 
	
	/*
	|--------------------------------------------------------------------------
	| OAuth Config
	|--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Note: ${provider} will be resolved automatically accordingly
    |--------------------------------------------------------------------------
    */
	'redirect_base_uri' => 'https://you-callback-url.local/login/${provider}',

	/*
    |--------------------------------------------------------------------------
	| Provider
    |--------------------------------------------------------------------------
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

    )
);
```

### Credentials

Add your credentials to ``app/config/laravel-4-social-oauth.php``


## Usage

### Basic usage

Just follow the steps below and you will be able to get a [service class object](https://github.com/jkbennemann/php-oauth-library/blob/master/src/Auth/Service.php) with this one rule:

```php
$service = OAuth::provider('github');
```

Optionally, add a second parameter with the URL which the service needs to redirect to, otherwise it will redirect to the current URL.

```php
$service = OAuth::provider('Github','http://url.to.redirect.to');
```

## Usage examples

### Github:

Configuration:
Add your Github credentials to the config file

In your Controller use the following code:

```php
/**
 * Login user with github
 *
 * @return void
 */

public function loginWithGithub() {
	
	// get data from input
	$code = Input::get( 'code' );
	
	// get github service
	$service = OAuth::provider( 'github' );
	
	// check if code is valid
	
	// if code is provided get user data and sign in
	if ( !empty( $code ) ) {
		
        // This was a callback request from github, get the token
        $accessToken  = $service->getAccessTokenByRequestParameters(Input::all());

        // fetch information for authorized token
        $user = $service->getIdentity($accessToken);
        
        var_dump($user);

        //perform user lookup e.g. User::findByEmail($user->email);
        //login User
        //redirect the user to any page
        
        exit();	
	} else {
	    // if not ask for permission first
		// get service authorization
		$url = $service->makeAuthUrl();
		
		// return to auth page
		 return Redirect::to($url);
	}

}
```