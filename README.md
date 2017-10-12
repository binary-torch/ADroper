# Add/Drop Courses Project
---

> Installation


Make sure you have installed [PHP](http://php.net/), [MySQL](https://www.mysql.com/), [Composer](https://getcomposer.org/), [Git](https://git-scm.com/) and [npm](https://www.npmjs.com/)

- Clone the project `git clone https://github.com/binary-torch/add-drop-courses.git IIUMAddDrop`
- Navigate to the project `cd IIUMAddDrop`
- Install dep. `composer install`
- Create app environment from the example `cp .env.example .env`
- Generate app key `php artisan key:generate`
- Install JS dep. `npm install`
- Build JS `npm run dev`
- Serve the app `php artisan serve`
- Visit in the browser: `http://localhost:8000/` or if you are using `valet` visit `IIUMAddDrop.dev`