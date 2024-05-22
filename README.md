# Software Engineering School 4.0 Case

## Опис завдання
Потрібно реалізувати сервіс з АРІ, який дозволить:
* дізнатись поточний курс долара (USD) у гривні (UAH);
* підписати емейл на отримання інформації по зміні курсу;
* емейли з актуальним курсом мають приходити всім підписаним користувачам один раз на добу.

## Додаткові вимоги
1. Всі данні, для роботи додатку повинні зберігатися в базі даних.
2. В репозиторії повинен бути Dockerfile та Docker Compose, який дозволяє запустити
   систему в Docker.

## Description

This API is implemented in PHP using the Laravel framework. 
The code follows a separated logic approach, making it easily readable and maintainable. 
The API has been thoroughly tested and is ready for deployment with minimal effort required.

## Usage
1. Docker
2. PHPComposer
3. PHPMailer
4. Nginx
5. Postgres

### Importing

```
git clone https://github.com/BlackSou/ses_4.git
```
```
cd ses_4
```
### Docker

Configured SMTP in environment:
```
nano docker-compose.yml
```
Deployment Docker containers:
```
docker-compose up -d
```
Set up dependencies:
```
docker-compose exec -ti php-fpm bash -c "composer install && php artisan migrate && exit"
```

Swagger:
```http://localhost:88/api/doc```
