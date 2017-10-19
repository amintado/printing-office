<?php
/*******************************************************************************
 * Copyright (c) 2017.
 * this file created in printing-office project
 * framework: Yii2
 * license: GPL V3 2017 - 2025
 * Author:amintado@gmail.com
 * Company:shahrmap.ir
 * Official GitHub Page: https://github.com/amintado/printing-office
 * All rights reserved.
 ******************************************************************************/

use common\models\base\Product;
use common\models\base\TicketHead;

return [
    //---------------- Global -------------------

    'Admin User Fullname'=>'مدیر سایت',
    'DELETE'=>'حذف',
    'Author Panel'=>'اطلاعات ناشر',
    'Authorَ'=>'ایجاد کننده:',
    'Updater'=>'بروزرسانی کننده: ',
    'Side Created At'=>'ایجاد شده در:',
    'Side Updated At'=>'بروزرسانی شده در:',
    'unknown'=>'ناشناس',
    'Cancel' => 'لغو',
    'User' => 'کاربر',
    'Edit' => 'ویرایش',
    'Profile' => 'ناحیه کاربری',
    'Logout' => 'خروج',
    'Sign Out' => 'خروج از حساب',
    'balance'=>'موجودی',
    'account balance'=>'موجودی حساب',
    'Increase in inventory'=>'افزایش موجودی',



    //---------------- User Profile Translation Fields -------------------
    'User Active' => 'فعال',
    'User Deleted' => 'غیر فعال',
    'ID' => 'شناسه',
    'Name' => 'نام',
    'Family' => 'نام خانوادگی',
    'Workname' => 'محل کار',
    'State' => 'استان',
    'City' => 'شهر',
    'Tel1' => 'تلفن تماس 1',
    'Tel2' => 'تلفن تماس 2',
    'Tel3' => 'تلفن تماس 3',
    'Mob1' => 'موبایل 1',
    'Mob2' => 'موبایل 2',
    'Birthday' => 'تاریخ تولد',
    'Website' => 'وبسایت',
    'Nationcode' => 'کد ملی',
    'Postalcode' => 'کد پستی',
    'Jobcategory' => 'رده ی شغلی',
    'Address' => 'آدرس',
    'File' => 'مدارک هویتی',

    //- User Map Location -
    'Lat' => 'Lat',
    'Lng' => 'Lng',


    'Charge' => 'موجودی حساب',


    'Role' => 'نقش',
    'Status' => 'وضعیت',
    'User - ID' => 'آی دی کاربر',
    'User - Name' => 'تلفن همراه',
    'User - Fullname' => 'نام و نام خانوادگی',
    'User - Role ID' => 'نقش کاربری',
    'User - Image' => 'تصویر کاربری',
    'User - Auth Key' => 'کلید رمز',
    'User - Access Token' => 'توکن دسترسی',
    'User - Password Hash' => 'هش رمز عبور',
    'User - Password Reset Token' => 'کد ریست کردن رمز عبور',
    'User - Email' => 'ایمیل کاربر',
    'User - Mobile' => 'موبایل کاربر',
    'User - Status' => 'وضعیت کاربری',
    'User - Last Login Ip' => 'آخرین آی پی ثبت شده',
    'User - Created At' => 'ثبت نام شده در تاریخ',
    'User - Updated At' => 'بروزرسانی شده در تاریخ',
    'User Profile View' => 'نمایه ی کاربر',


    'Select' => 'لطفا انتخاب کنید',
    'Grid Export All' => 'استخراج همه ی اطلاعات',

    //---------------- Alerts -------------------

    'NationCode Length' => 'کد ملی باید {num} رقمی باشد',
    'Numbers of the national code should not be equal' => 'اعداد کد ملی نباید با هم برابر باشند',
    'National Code is not valid' => 'کد ملی معتبر نیست',
    'email' => 'ایمیل',
    'Address Hint' => '*این آدرس برای ارسال سفارش شما استفاده می شود.',
    'DELETE ALERT TITLE'=>'شما درخواست حذف داشتید',
    'Not Dleted'=>'پاک نشد',
    'Hard Delete Alert Message'=>'در صورت حذف، این مورد قابل بازگردانی نیست، آیا از حذف این مورد اطمینان کامل دارید؟',


    'Account Details' => 'اطلاعات حساب',
    'User Address Detail' => 'اطلاعات سکونت',
    'User Call Detail' => 'اطلاعات تماس',
    'User Accessblity'=>'دسترسی ها',
    'User Inquery'=>'استعلام ها',
    'User Invoices'=>'صورت حساب ها',
    'User Notifications'=>'اعلامیه های کاربر',
    'User Order'=>'سفارش ها',
    'User Tickets'=>'تیکت ها',
    'User Transactions'=>'تراکنش های مالی',


    //---------------- Frontend SignUp Form -------------------

    'SinUp-1' => 'لطفا شماره همراه خود را برای ثبت نام وارد کنید:',
    'mobile' => 'تلفن همراه',
    'VerificationCode' => 'کد اعتبار سنجی:',
    'This mobile has already been taken.' => 'این شماره ی تلفن همراه قبلا ثبت نام شده است',



    //---------------- Product -------------------
    'Product Status -' . Product::STATUS_ACTIVR => 'منتشر شده',
    'Product Status -' . Product::STATUS_INACTIVE => 'پیش نویس',
    'Product Details'=>'اطلاعات محصول',

    //---------------- Ticket -------------------

    'Ticket Department-'.TicketHead::TOPIC_ACCOUNTING=>'بخش مالی',
    'Ticket Department-'.TicketHead::TOPIC_TECHNICAL=>'بخش فنی',


    'Ticket Status-'.TicketHead::STATUS_ANSWERED=>'پاسخ داده شد',
    'Ticket Status-'.TicketHead::STATUS_CLOSE=>'بسته شد',
    'Ticket Status-'.TicketHead::STATUS_USER_ANSWER=>'پاسخ مشتری',
    'Ticket Status-'.TicketHead::STATUS_WAITING=>'در حال انتظار',

    //---------------- Menus -------------------

    'Profile Side Tickets'=>'پشتیبانی',
    'answered by'=>'کاربر پاسخگو',
    'Qdescription'=>'متن درخواست',
    'Qfile'=>'فایل پیوست',
    'Qdate'=>'زمان درخواست',
    'Adate'=>'زمان پاسخ',
    'Afile'=>'فایل پیوست',
    'Adescription'=>'متن پاسخ',
    'Category'=>'موضوع استعلام',


];