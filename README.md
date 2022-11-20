## Laravel API & Mail Example

A simple laravel app to get API data from 3rd Party and sending an email.

### Setup

To test emails locally install Mailcatcher via docker:

```bash
$ docker pull dockage/mailcatcher:latest

$ docker run --name='mailcatcher' -d \
  --publish=1080:1080 \
  --publish=1025:1025 \
dockage/mailcatcher:latest
```
To view emails http://localhost:1080

SMTP port for sending emails 1025

Sample mail config for laravel:
```dotenv
MAIL_MAILER=smtp
MAIL_HOST=localhost
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="noreply@megapost.local"
MAIL_FROM_NAME="${APP_NAME}"
```

To run the app:
```bash
./artisan serve
```

### Routes
Routes are listed in the root endpoint: http://localhost:8000
