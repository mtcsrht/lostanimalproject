
# Lost animal project

Our community-based lost animal finder web application puts the power of finding lost pets back in your hands.  Quickly view lost animals near you or across Hungary. If your pet is missing, register for an account to easily upload information about your furry friend.  For those who find a lost pet, our integrated chat system allows you to connect directly with the worried owner.


## Installation
First clone this repository:

```bash
git clone https://github.com/mtcsrht/lostanimalproject.git
```
Install composer:

```bash
cd project-name
composer install
```

Install npm dependencies:
```bash
cd project-name
npm install
```
Create your .env file  
```bash
cd project-name
cp .env.example .env
```
Migrate the database *(project-name/database/migrations)*
```bash
cd project-name
php artisan migrate
```

Generate your key to the application : 
```bash
cd project-name
php artisan key:generate
```
Run the built-in development server:
```bash
cd project-name
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