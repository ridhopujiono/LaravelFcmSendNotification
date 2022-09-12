# Installation

    composer require ridhopujiono/fcm-send-notification

# Before Usage

You must insert a new column for the User model

    php artisan make:migration add_device_token_to_users

After run that command, open the migration and edit into this

    Schema::table('users', function (Blueprint  $table) {
        $table->string('device_token')->nullable();
    });

Do Migrate

    php artisan migrate

Set env file

-   Open your .env file
-   Add new line in bottom and do add code like this

    `SERVER_KEY_FCM='YOUR SERVER KEY FROM FIREBASE'`

Notice :

> you have to fill in the device token field yourself. somehow. because in general to retrieve the device token a client-side language is needed (such as Javascript)

# Usage

Use first

    use RidhoPujiono\FcmSendNotification;

Send notification to all user

    FcmSendNotification::sendNotificationAll($title, $body, $urlClick);

Send notification to specific user

    FcmSendNotification::sendNotificationSingle($user_id, $title, $body);
