<?php return array (
  'facade/ignition' => 
  array (
    'providers' => 
    array (
      0 => 'Facade\\Ignition\\IgnitionServiceProvider',
    ),
    'aliases' => 
    array (
      'Flare' => 'Facade\\Ignition\\Facades\\Flare',
    ),
  ),
  'fruitcake/laravel-cors' => 
  array (
    'providers' => 
    array (
      0 => 'Fruitcake\\Cors\\CorsServiceProvider',
    ),
  ),
  'laravel/nexmo-notification-channel' => 
  array (
    'providers' => 
    array (
      0 => 'Illuminate\\Notifications\\NexmoChannelServiceProvider',
    ),
  ),
  'laravel/sail' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Sail\\SailServiceProvider',
    ),
  ),
  'laravel/sanctum' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Sanctum\\SanctumServiceProvider',
    ),
  ),
  'laravel/tinker' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Tinker\\TinkerServiceProvider',
    ),
  ),
  'nesbot/carbon' => 
  array (
    'providers' => 
    array (
      0 => 'Carbon\\Laravel\\ServiceProvider',
    ),
  ),
  'nexmo/laravel' => 
  array (
    'providers' => 
    array (
      0 => 'Nexmo\\Laravel\\NexmoServiceProvider',
    ),
    'aliases' => 
    array (
      'Nexmo' => 'Nexmo\\Laravel\\Facade\\Nexmo',
    ),
  ),
  'nunomaduro/collision' => 
  array (
    'providers' => 
    array (
      0 => 'NunoMaduro\\Collision\\Adapters\\Laravel\\CollisionServiceProvider',
    ),
  ),
  'seshac/otp-generator' => 
  array (
    'providers' => 
    array (
      0 => 'Seshac\\Otp\\OtpServiceProvider',
    ),
    'aliases' => 
    array (
      'Otp' => 'Seshac\\Otp\\OtpFacade',
    ),
  ),
);