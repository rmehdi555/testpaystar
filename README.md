## تست api

## مراحل اجرای پروژه

1- php artisan migrate

2- php artisan test 

3- php artisan db:seed


به دلیل اینکه خواسته شده از احراز هویت استفاده نشود لذا از user_id برای درخواست ها استفاده شده
در صورت استفاده از احراز هویت jwt با ارسال توکن کاربر امنیت درخواست ها بالاتر خواهد بود
اجرای Url در Postman

## دریافت اطلاعات بانکی کاربر و ذخیره آن
http://127.0.0.1:8000/api/v1/user/bank/details?user_id=1&firstname=mehdi&lastname=rezaie&number=IR1000001251&token=123456


 
 
## دریافت اطلاعات انتقال از کاربر و ذخیره آن

http://127.0.0.1:8000/api/v1/transactions/create?user_id=1&token=123456&amount=15000&destinationFirstname=mehdi&destinationLastname=rezaie&destinationNumber=IR12500000555558858&description=33&user_bank_details_id=1





## ارسال اطلاعات انتقال به api

http://127.0.0.1:8000/api/v1/transactions/request?user_id=1&token=123456&transaction_id=1





## دریافت تراکنش های کاربر

http://127.0.0.1:8000/api/v1/transactions/show?user_id=1&token=123456
