# phpcoco
用composer组装的php框架
1.使用的扩展集合

```
路由 "noahbuscher/macaw": "dev-master",
视图  "twig/twig": "^2.12",
模型  "catfan/medoo": "^2.1",
分页应用库  "jasongrimes/paginator": "~1.0"
```

2.配置

apache下面配置.htaccess文件

```
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /
    # Allow any files or directories that exist to be displayed directly
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php?$1 [QSA,L]
</IfModule>
```

nginx下配置

```
rewrite ^/(.*)/$ /$1 redirect;
if (!-e $request_filename){
    rewrite ^(.*)$ /index.php break;
}
```