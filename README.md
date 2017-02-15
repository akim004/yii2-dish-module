Yii2 Dish module
===================================

INSTALLATION
------------

1. composer
2. Add in config
    `'bootstrap' => [
        'akim04\dish\Bootstrap',
    ]`,
    and
    `'modules' => [
        'dish' => [
            'class' => 'akim04\dish\Module',
        ],
    ]`
3.php yii migrate --migrationPath=@akim04/dish/migrations

