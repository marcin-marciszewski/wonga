# Wonga zadanie

### Instalacja:

##### 1. Uruchom dockera:

Z folderu źródłowego

```
docker-compose up -d
```

##### 2. Połącz się z terimalem kontenera.

Z folderu źródłowego

```
docker exec -it php bash
```

##### 3. Instalacja backendu:

Z folderu źródłowego kontenera

```
composer install
```

##### 4. Uruchom migracje bazy danych.

Z folderu źródłowego kontenera

```
bin/console doctrine:migrations:migrate

```

##### 4. Uruchom migracje bazy danych.

Z folderu źródłowego kontenera

```
bin/console doctrine:migrations:migrate

```

##### 4. Populacja bazy danych.

Z folderu źródłowego kontenera

```
php bin/console doctrine:fixtures:load
```

##### 5. Otwórz projekt na: http://localhost:8080/products
