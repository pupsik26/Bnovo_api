```shell
docker-compose up -d
```
Из под docker контейнера запускаем
```
composer install
```
```
php artisan migrate
```
api достпно по хоту localhost:8080

Получить список гостей <br>
```GET /api/guest```

Получить гостя по id <br>
```GET /api/guest/{id}```

Создать гостя
```POST /api/guest```

Обновить данные гостя <br>
```PUT /api/guest/{id}```

Удалить данные о госте <br>
```DELETE /api/guest/{id}```

Тело запроса при POST/PUT методах
- `name` - string | required
- `surname` - string | required
- `phone` - string | required | unique (формат +7 и т.д.)
- `email` - string | required | unique
- `country` - string
