# Sens-API package for Laravel 10
API для датчиков и SPA-приложения

## Download
`````
composer require odboxxx/sens-api
`````

## Install
`````
php artisan sensapi:install
`````
`````
php artisan migrate
`````

## Usage
### request from sensors
`````
GET yourdomain/api?<parameter>=<value>
`````

#### parameters:

| Parameter | Type | Desc |
|---|---|---|
| sensor | integer | sensor id (**required**) |
| T | decimal | температура (**conditional**) для датчика 1 |
| P | decimal | давление (**conditional**) для датчика 2 |
| v | decimal | скорость вращения (**conditional**) для датчика 3 |

### response from API
Content-Type: application/json

| Parameter | Type | Desc |
|---|---|---|
| result | integer | id показателя или 0, если фиксация показателя не удалась |

#### example
`````
{
  "result":1
}
`````

### request from SPA
`````
GET yourdomain/api/spa?<parameter>=<value>
`````

#### parameters:

| Parameter | Type | Desc |
|---|---|---|
| sensors | array of int | массив sensor id (**required**)|
| sdate | integer | дата, время начала отчётного периода (**required**) Unix timestamp |
| edate | integer | дата, время завершения отчётного периода (**required**) Unix timestamp |

### response from API
Content-Type: application/json

| Parameter | Type | Desc |
|---|---|---|
| cases_quant_total | integer | количество запросов принятых от датчиков всего |
| data | array | массив с данными полученными от датчиков |
| sensor_id | integer | id датчика |
| cases_quant | integer | количество запросов принятых от определенного датчика |
| cases | array | массив с данными полученными от определенного датчика |
| value | decimal | значение параметра датчика |
| time | integer | дата, время фиксации параметра Unix timestamp |

#### example
`````
{
    "cases_quant_total": 4,
    "data": [
        {
            "sensor_id": 2,
            "cases_quant": 3,
            "cases": [
                {
                    "value": 45,
                    "time": 1742704244
                },
                {
                    "value": 50,
                    "time": 1742704265
                },
                {
                    "value": 55,
                    "time": 1742707457
                }
            ]
        },
        {
            "sensor_id": 1,
            "cases_quant": 1,
            "cases": [
                {
                    "value": 30,
                    "time": 1742707466
                }
            ]
        }
    ]
}
`````
