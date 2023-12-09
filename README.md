# Wtheq 
## Installation
### Step 1: Clone the repository
```bash
$ git clone https://github.com/mohamedSalehHegazy/Wtheq.git
```
### Step 2: Install dependencies
```bash
$ composer install
```
### Step 2: Config Project
- Create .env file 
```bash
$ cp .env.example .env
```
- Generate JWT secret key
```bash
$ php artisan jwt:secret
```
- Migrate database tables and seeders to fill tables with necessary data
```bash
$ php artisan migrate --seed
```
- Run Project
```bash
$ php artisan serve
```
- Import postman collection located at `/docs/PostmanCollection` folder