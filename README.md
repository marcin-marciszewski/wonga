# Wonga zadanie

### Instalacja:

##### 1. Instalacja frontendu:

Z folderu źródłowego

```
cd frontend
npm install
```

##### 2. Uruchom dockera:

Z folderu źródłowego

```
docker-compose up -d
```

##### 3. Instalacja backendu:

Z folderu źródłowego

```
cd app
composer install
```

##### 4. Uruchom migracje bazy danych.

Z folderu źródłowego

```
docker-compose run --rm php bin/console doctrine:migrations:migrate

```

albo z folderu źródłowego

```
docker exec -it php bash
bin/console doctrine:migrations:migrate
```

##### 5. Otwórz projekt na: http://localhost:3000/
