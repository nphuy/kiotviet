## Cài đặt và sử dụng
Cài đặt qua composer:

```sh
composer require hnp/kiotviet
```

## Cấu hình

Thêm đoạn sau và đầu dự án.

```php
require 'vendor/autoload.php';
```
Sử dụng:

```php
use Huynp\Kiotviet\Client;
use Huynp\Kiotviet\Product;
use Huynp\Kiotviet\Category;

$client = new Client($client_id, $client_secret);

Lấy danh sách sản phẩm bao gồm tồn kho:

$instance = new Product($client);
var_dump($instance->getList($limit = 20, $page = 0));

Lấy danh sách Danh mục sản phẩm:

$instance = new Category($client);
var_dump($instance->getList($limit = 20, $page = 0));

## Đang cập nhật...
