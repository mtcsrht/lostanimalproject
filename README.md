
# Lost animal project

Our community-based lost animal finder web application puts the power of finding lost pets back in your hands.  Quickly view lost animals near you or across Hungary. If your pet is missing, register for an account to easily upload information about your furry friend.  For those who find a lost pet, our integrated chat system allows you to connect directly with the worried owner.


## Installation

First clone this repository:

```bash
git clone https://github.com/mtcsrht/lostanimal-project.git
```
Install composer:

```bash
cd lostanimal-project
composer install
```

Install npm dependencies:
```bash
npm install
```
Create your .env file  
```bash
cp .env.example .env
```
Edit .env file to connect to your database
```
DB_CONNECTION=mysql
DB_HOST={server name, or ip address}
DB_PORT=3306
DB_DATABASE={your database name}
DB_USERNAME=root
DB_PASSWORD=
```
Before migration you have to create the table you connect to
Migrate the database *(lostanimal-project/database/migrations)*
```bash
php artisan migrate
```

Generate your key to the application : 
```bash
php artisan key:generate
```
Run the built-in development server:
```bash
php artisan serve
```
Run the Node.js server:
```bash
npm run dev
```
## Prerequisites
- **PHP** >= 8.1  
- **Composer**  
- **Node.js**  
- **npm package manager**  
- **MySQL Server**
