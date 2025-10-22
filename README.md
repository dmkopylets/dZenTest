## Dmytro Kopylets
***

**my contacts:**
* dm.kopylets@gmail.com
* https://t.me/Dmytro_Kopylets

***

**dzenCode Test Task (SPA-application: Comments)**

***

Full text of the task here [task](task%2FPHP_Laravel_SPA_Application_comments.pdf)

***

git clone https://github.com/dmkopylets/dZenTest.git
cd dZenTest

    copy file .env.example to .env
    mkdir -p storage/framework/views
    mkdir -p storage/framework/cache
    mkdir -p storage/framework/sessions

    chmod -R 775 storage bootstrap/cache
    chown -R www-data:www-data storage bootstrap/cache

    composer install

    npm install
    npm run build
    php artisan storage:link
    php artisan migrate

**it will be possible to test the application in a browser at localhost**

**  http://localhost - You will see a frontend built using Laravel
    ![frontend.png](task%2Ffrontend.png) 

**  http://localhost/api/v1/articles ... - API responses
    ![backend.png](task%2Fbackend.png)   

**  http://localhost/api/documentation - Swagger API documentation
    ![documentation.png](task%2Fdocumentation.png)    




