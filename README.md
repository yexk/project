# project for `dev01`

2018年4月6日13:24:44 -> update laravel 5.5.40

## 后台

- 文章分类管理（增删改查）
- 文章管理（增删改查）
- 用户管理（增删改查）
- 发邮件功能（`phpmailer`,`redis`）
- 聊天室【群聊】（`workerman`,`redis`）

## 前台
> 待定

## 其他说明

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

