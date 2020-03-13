# Royalcms-Elasticsearch

在Laravel或Royalcms应用程序中使用 [官方Elastic Search客户端](https://github.com/elastic/elasticsearch-php) 的简便方法。

- [Royalcms-Elasticsearch](#royalcms-elasticsearch)
  - [安装与配置](#installation-and-configuration)
    - [通过.env文件的替代配置方法](#alternative-configuration-method-via-env-file)
  - [用法](#usage)
  - [高级用法](#advanced-usage)
  - [Copyright and License](#copyright-and-license)



## 安装与配置

通过composer安装最新版本的 `royalcms/royalcms-elasticsearch` 软件包：

```sh
composer require royalcms/royalcms-elasticsearch
```

##### 通过.env文件的替代配置方法

按照上述建议发布配置文件后，可以配置ElasticSearch
通过将以下内容添加到应用程序的 `.env` 文件中（具有适当的值）：
  
```ini
ELASTICSEARCH_HOST=localhost
ELASTICSEARCH_PORT=9200
ELASTICSEARCH_SCHEME=http
ELASTICSEARCH_USER=
ELASTICSEARCH_PASS=
```

## 用法

`Elasticsearch` 外观只是 [ES客户端](https://github.com/elastic/elasticsearch-php) 的入口点，因此以前您可能使用过：

```php
$data = [
    'body' => [
        'testField' => 'abc'
    ],
    'index' => 'my_index',
    'type' => 'my_type',
    'id' => 'my_id',
];

$client = ClientBuilder::create()->build();
$return = $client->index($data);
```

现在，您可以将后两行替换为：

```php
$return = Elasticsearch::index($data);
```
这将在默认连接上运行命令。 您可以在以下位置运行命令
任何连接（请参见 `defaultConnection` 设置和 `connections` 数组
配置文件）。

```php
$return = Elasticsearch::connection('connectionName')->index($data);
```

## 高级用法

因为该软件包是官方Elastic客户端的包装，所以您可以
使用此程序包几乎可以做任何事情。 您不仅可以执行标准
CRUD操作，但您可以通过编程方式监视弹性集群的运行状况，
备份它，或对其进行更改。 其中一些操作是通过
此程序包愉快地支持的“命名空间”命令。

要获取索引的统计信息：

```php
$stats = Elasticsearch::indices()->stats(['index' => 'my_index']);
$stats = Elasticsearch::nodes()->stats();
$stats = Elasticsearch::cluster()->stats();
```

要创建和还原快照（请首先阅读有关创建存储库路径和插件的Elastic文档）：

```php
$response = Elasticsearch::snapshots()->create($params);
$response = Elasticsearch::snapshots()->restore($params);
```

要删除整个索引（请注意！）：

```php
$response = Elasticsearch::indices()->delete(['index' => 'my_index']);
```

请记住，此软件包是许多非常复杂且有据可查的Elastic功能的薄包装。 
有关这些功能以及用于调用它们的方法和参数的信息可以在 [Elastic文档](https://www.elastic.co/guide/en/elasticsearch/client/php-api/current/index.html) 中找到。 
可通过 [Elastic论坛](https://discuss.elastic.co/) 以及 [Stack Overflow](https://stackoverflow.com/questions/tagged/elasticsearch) 之类的网站获得有关使用它们的帮助。


## Copyright and License

[royalcms-elasticsearch](https://github.com/royalcms/royalcms-elasticsearch)
was written by [Royal Wang](https://royalcms.cn) and is released under the 
[MIT License](LICENSE.md).

Copyright (c) 2020 Royal Wang
