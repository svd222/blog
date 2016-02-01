1) you need to configure the `db` component in config/db.php
2) configure authManager component in a config/console.php
    e.g.
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
3) up the migrates:
    a) yii migrate/up --migrationPath=@vendor/dektrium/yii2-user/migrations
    b) yii migrate/up --migrationPath=@yii/rbac/migrations
    c) yii migrate/up
4) create the user through this link http://yoursite/user/register
5) if you not yet configured `mailer` component then signin in db and change the confirmed_at field of correspond row (newly created user) {{%user}} table 
to current TIMESTAMP. current TIMESTAMP you may get from created_at field.