# OurSMS-Laravel

Laravel [OurSMS](https://oursms.app) API Integration

# Installation

1. Require the package into your Laravel application:

```
$ composer require munafio/oursms-laravel
```

2. Install OurSMS using the following artisan command:

```
$ php artisan oursms:install
```

this will publish the configurations and create `oursms` environment variables inside your application's `.env` file and setups everything for you.

3. Modify the following variables in your application's `.env` with your OurSMS Account's credentials:

```
...
OURSMS_USER_ID=
OURSMS_SECRET_KEY=
```

That's it, enjoy :)

# Quick Start

you can easily use this package inside your application, all you need is to import package's `facade` anywhere inside your application (e.g. inside the controllers) as the following:

```
use Munafio\OurSMS\Facades\OurSMS;
```

**or**, you can use it directly without importing the `facade` as the following:

```
...
public function example(Request $request){
	...
	OurSMS::sendOSM(...,...);
	...
}
...
```

# Available Methods

### Send One Single Message ( OSM )

```
OurSMS::sendOSM($phoneNumber, $message);
```

### Send One Time Password ( OTP )

```
OurSMS::sendOTP($phoneNumber, $message);
```

### Get Status for SMS

```
OurSMS::getStatus($phoneNumber, $message);
```

# Configurations

You can find the configurations file at `config/oursms.php` in your application, which contains the following properties:

```
/*
|-------------------------------------
| OurSMS service credentials
|-------------------------------------
*/
'user_id'  =>  env('OURSMS_USER_ID',  null),
'secret_key'  =>  env('OURSMS_SECRET_KEY',  null),
```

- `user_id` you own user id in the website.
- `secret_key` your own secret key you can find it next to the `user id` in the website.

```
/*
|-------------------------------------
| OurSMS service API base_uri
|-------------------------------------
*/
'base_uri'  =>  'https://oursms.app/api​/v1​/SMS'
```

- `base_uri` is the base url of `OurSMS `service's endpoints.

## Author

[Munaf A. Mahdi](https://www.munafio.com/p/contact-me.html)

## License

[MIT](https://choosealicense.com/licenses/mit/)