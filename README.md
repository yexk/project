# project master

目前处于开发阶段。详情请看dev01分支

```shell
composer install
composer dump-autoload	
php artisan migrate
php artisan db:seed
# 启动队列服务器
php artisan queue:work 
php artisan storage:link
```

目录权限#

安装 Laravel 之后， 你需要配置一些权限 。 `storage` 和 `bootstrap/cache` 目录应该允许你的 Web 服务器写入，否则 Laravel 将无法写入。