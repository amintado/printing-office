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

/**
 * Created by PhpStorm.
 * User: amin__000
 * Date: 10/20/2017
 * Time: 3:58 AM
 */

namespace console\controllers;

use Yii;
use yii\console\Controller;

class ConsoleController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        //<Product controller>
        {
            $productIndex = $auth->createPermission('productIndex');
            $productIndex->description = ' نمایش لیست محصولات در ادمین';
            $auth->add($productIndex);

            // add "updatePost" permission
            $productView = $auth->createPermission('productView');
            $productView->description = 'نمایش اطلاعات یک محصول در ادمین';
            $auth->add($productView);

            $productCreate = $auth->createPermission('productCreate');
            $productCreate->description = 'ایجاد محصول در ادمین';
            $auth->add($productCreate);

            $productUpdate = $auth->createPermission('productUpdate');
            $productUpdate->description = 'بروزرسانی اطلاعات مخصول در ادمین';
            $auth->add($productUpdate);

            $productDelete = $auth->createPermission('productDelete');
            $productDelete->description = 'حذف کردن محصول در ادمین';
            $auth->add($productDelete);

            $productPdf = $auth->createPermission('productPdf');
            $productPdf->description = 'نمایش خروجی PDF از محصول در ادمین';
            $auth->add($productPdf);

            // add "author" role and give this role the "createPost" permission
            $productmanager = $auth->createRole('productmanager');
            $productmanager->description='این نقش را به مدیر محصولات بدهید، تا بتواند همه ی محصولات سیستم را مدیریت کند، مدیریت محصوللات شامل ایجاد، ویرایش،حذف یک محصول با تمام ویژگی هایش میباشد.';
            $auth->add($productmanager);
            $auth->addChild($productmanager, $productIndex);
            $auth->addChild($productmanager, $productView);
            $auth->addChild($productmanager, $productCreate);
            $auth->addChild($productmanager, $productUpdate);
            $auth->addChild($productmanager, $productDelete);
            $auth->addChild($productmanager, $productPdf);

            $adminManager = $auth->createRole('admin');
            $adminManager->description='این نقش را به مدیر کل سیستم بدهید، که میتواند همه ی اجراء سیستم را بدون محدودیت تغییر دهد.';
            $auth->add($adminManager);
            $auth->addChild($adminManager, $productIndex);
            $auth->addChild($adminManager, $productView);
            $auth->addChild($adminManager, $productCreate);
            $auth->addChild($adminManager, $productUpdate);
            $auth->addChild($adminManager, $productDelete);
            $auth->addChild($adminManager, $productPdf);
        }
        //</Product controller>

        

        //<Slide Controller>
        {
            $SlideManage = $auth->createPermission('SlideManage');
            $SlideManage->description = 'مدیریت اسلایدها در ادمین';
            $auth->add($SlideManage);

            $SlideHelp = $auth->createPermission('SlideHelp');
            $SlideHelp->description = 'نمایش راهنمای اسلاید در ادمین';
            $auth->add($SlideHelp);

            $SlideManager = $auth->createRole('SlideManager');
            $SlideManager->description='این نقش را به فردی بدهید که قرار است اسلایدهای سیستم را طراحی کند و بر روی سایت قرار دهد.';
            $auth->add($SlideManager);
            $auth->addChild($SlideManager, $SlideHelp);
            $auth->addChild($SlideManager, $SlideManage);


            $auth->addChild($adminManager, $SlideHelp);
            $auth->addChild($adminManager, $SlideManage);


        }
        //</Slide Controller>


        //<Users Controller>
        {
            $userIndex = $auth->createPermission('userIndex');
            $userIndex->description = 'لیست کاربران در ادمین';
            $auth->add($userIndex);

            $userView = $auth->createPermission('userView');
            $userView->description = 'نمایش اطلاعات کاربران در ادمین';
            $auth->add($userView);

            $userCreate = $auth->createPermission('userCreate');
            $userCreate->description = 'ایجاد کاربر جدید در ادمین';
            $auth->add($userCreate);

            $userUpdate = $auth->createPermission('userUpdate');
            $userUpdate->description = 'تغییر اطلاعات یک کاربر در ادمین';
            $auth->add($userUpdate);

            $userDelete = $auth->createPermission('userDelete');
            $userDelete->description = 'حذف یک کاربر در ادمین';
            $auth->add($userDelete);

            $userHelp = $auth->createPermission('userHelp');
            $userHelp->description = 'دیدن راهنمای سیستم دسترسی ها در ادمین';
            $auth->add($userHelp);

            $userAccess = $auth->createPermission('userAccess');
            $userAccess->description = 'تنظیم دسترسی های کاربران در ادمین';
            $auth->add($userAccess);


            $userManager = $auth->createRole('userManager');
            $userManager->description='این نقش را به کاربری بدهید که قرار است کاربران دیگر را مدیریت کند.یعنی میتواند رمز یک کاربر را عوض کند، یا اطلاعات دیگر وی را تغییر دهد.';
            $auth->add($userManager);
            $auth->addChild($userManager, $userIndex);
            $auth->addChild($userManager, $userView);
            $auth->addChild($userManager, $userCreate);
            $auth->addChild($userManager, $userUpdate);
            $auth->addChild($userManager, $userDelete);
            $auth->addChild($userManager, $userHelp);


            $userAccessManager = $auth->createRole('userAccessManager');
            $userAccessManager->description='این نقش را به کاربری بدهید که مورد اطمینان باشد، زیرا دسترسی همه ی کاربران به بخش های سیستم را میتواند این کاربر تغییر دهد، مثلا میتواند از دسترسی یک کاربر خاص به یک یا چند بخش در پنل میدیرت جلوگیری کند یا برای دیگر کاربران دسترسی های غیر مجاز را باز کند.پس در تخصیص این نقش به کاربران نهایت دقت را بخرج دهید.:)';
            $auth->add($userAccessManager);
            $auth->addChild($userAccessManager, $userAccess);


            $auth->addChild($adminManager, $userIndex);
            $auth->addChild($adminManager, $userView);
            $auth->addChild($adminManager, $userCreate);
            $auth->addChild($adminManager, $userUpdate);
            $auth->addChild($adminManager, $userDelete);
            $auth->addChild($adminManager, $userHelp);

            $auth->addChild($adminManager, $userAccess);



        }
        //</Users Controller>

        //<InqueryCategory Controller>
        {
            $userIndex = $auth->createPermission('InqueryCategoryIndex');
            $userIndex->description = 'لیست  دسته بندی استعلام  در ادمین';
            $auth->add($userIndex);

            $userView = $auth->createPermission('InqueryCategoryView');
            $userView->description = 'نمایش اطلاعات  دسته بندی استعلام  در ادمین';
            $auth->add($userView);

            $userCreate = $auth->createPermission('InqueryCategoryCreate');
            $userCreate->description = 'ایجاد  دسته بندی استعلام  جدید در ادمین';
            $auth->add($userCreate);

            $userUpdate = $auth->createPermission('InqueryCategoryUpdate');
            $userUpdate->description = 'تغییر اطلاعات یک  دسته بندی استعلام  در ادمین';
            $auth->add($userUpdate);

            $userDelete = $auth->createPermission('InqueryCategoryDelete');
            $userDelete->description = 'حذف یک دسته بندی استعلام  در ادمین';
            $auth->add($userDelete);

            $userHelp = $auth->createPermission('InqueryCategoryHelp');
            $userHelp->description = 'دیدن راهنمای  دسته بندی استعلام  در ادمین';
            $auth->add($userHelp);


            $InqueryCategoryManager = $auth->createRole('InqueryCategoryManager');
            $InqueryCategoryManager->description='این نقش را به کاربری بدهید که میخواهید دسته بندی های بخش استعلام را تنظیم کند،اما این کاربر به درخواست های ارسالی از کاربران دسترسی ندارد.';
            $auth->add($InqueryCategoryManager);
            $auth->addChild($InqueryCategoryManager, $userIndex);
            $auth->addChild($InqueryCategoryManager, $userView);
            $auth->addChild($InqueryCategoryManager, $userCreate);
            $auth->addChild($InqueryCategoryManager, $userUpdate);
            $auth->addChild($InqueryCategoryManager, $userDelete);
            $auth->addChild($InqueryCategoryManager, $userHelp);


            $auth->addChild($adminManager, $userIndex);
            $auth->addChild($adminManager, $userView);
            $auth->addChild($adminManager, $userCreate);
            $auth->addChild($adminManager, $userUpdate);
            $auth->addChild($adminManager, $userDelete);
            $auth->addChild($adminManager, $userHelp);



        }
        //</InqueryCategory Controller>


        //<Inquery Controller>
        {
            $userIndex = $auth->createPermission('InqueryIndex');
            $userIndex->description = 'لیست استعلام ها در ادمین';
            $auth->add($userIndex);

            $userView = $auth->createPermission('InqueryView');
            $userView->description = 'نمایش اطلاعات استعلام ها در ادمین';
            $auth->add($userView);

            $userCreate = $auth->createPermission('InqueryCreate');
            $userCreate->description = 'ایجاد استعلام ها جدید در ادمین';
            $auth->add($userCreate);

            $userUpdate = $auth->createPermission('InqueryUpdate');
            $userUpdate->description = 'تغییر اطلاعات یک استعلام ها در ادمین';
            $auth->add($userUpdate);

            $userDelete = $auth->createPermission('InqueryDelete');
            $userDelete->description = 'حذف یک استعلام ها در ادمین';
            $auth->add($userDelete);

            $userHelp = $auth->createPermission('InqueryHelp');
            $userHelp->description = 'دیدن راهنمای استعلام ها در ادمین';
            $auth->add($userHelp);

            $userConfirm = $auth->createPermission('InqueryConfirm');
            $userConfirm->description = 'تایید استعلام ها در ادمین';
            $auth->add($userConfirm);

            $inqueryAuth = $auth->createRole('InqueryManager');
            $inqueryAuth->description='این نقش را به فردی بدهید که قرار است درخواست های استعلام قیمت کاربران سایت را مدیریت کند.میتواند به یک درخواست پاسخ دهد یا آن را ببندد یا حتی آن را حذف کند.';
            $auth->add($inqueryAuth);
            $auth->addChild($inqueryAuth, $userIndex);
            $auth->addChild($inqueryAuth, $userView);
            $auth->addChild($inqueryAuth, $userCreate);
            $auth->addChild($inqueryAuth, $userUpdate);
            $auth->addChild($inqueryAuth, $userDelete);
            $auth->addChild($inqueryAuth, $userHelp);
            $auth->addChild($inqueryAuth, $userConfirm);

            $auth->addChild($adminManager, $userIndex);
            $auth->addChild($adminManager, $userView);
            $auth->addChild($adminManager, $userCreate);
            $auth->addChild($adminManager, $userUpdate);
            $auth->addChild($adminManager, $userDelete);
            $auth->addChild($adminManager, $userHelp);
            $auth->addChild($adminManager, $userConfirm);



        }
        //</Inquery Controller>




        //<PaySettings Controller>
        {
            $SettingsAuth = $auth->createPermission('Settings');
            $SettingsAuth->description = 'تنظیمات سیستم در ادمین';
            $auth->add($SettingsAuth);

            $settingsAuth = $auth->createRole('SettingsManager');
            $settingsAuth->description='این نقش را به کاربری که میخواهید مدیر تنظیمات سیستم باشد بدهید';
            $auth->add($settingsAuth);
            $auth->addChild($settingsAuth, $SettingsAuth);

            $auth->addChild($adminManager, $SettingsAuth);



        }
        //</PaySettings Controller>





        //<TicketAdmin Controller>
        {
            $userIndex = $auth->createPermission('TicketAdminIndex');
            $userIndex->description = 'لیست تیکت در ادمین';
            $auth->add($userIndex);

            $userView = $auth->createPermission('TicketAdminView');
            $userView->description = 'نمایش اطلاعات تیکت در ادمین';
            $auth->add($userView);

            $userCreate = $auth->createPermission('TicketAdminCreate');
            $userCreate->description = 'ایجاد تیکت جدید در ادمین';
            $auth->add($userCreate);

            $TicketAdminClosed = $auth->createPermission('TicketAdminClosed');
            $TicketAdminClosed->description = 'بستن یک تیکت در ادمین';
            $auth->add($TicketAdminClosed);

            $userDelete = $auth->createPermission('TicketAdminDelete');
            $userDelete->description = 'حذف یک تیکت در ادمین';
            $auth->add($userDelete);

            $TicketAdminOpen = $auth->createPermission('TicketAdminOpen');
            $TicketAdminOpen->description = 'باز کردن تیکت در ادمین';
            $auth->add($TicketAdminOpen);

            $TicketAdminAnswer = $auth->createPermission('TicketAdminAnswer');
            $TicketAdminAnswer->description = 'پاسخ به تیکت در ادمین';
            $auth->add($TicketAdminAnswer);

            $ticketAuth = $auth->createRole('TicketAdminManager');
            $ticketAuth->description='این نقش را به کاربر یا کاربرانی بدهید که میخواهید به سیستم پشتیبانی دسترسی داشته باشند، آنها میتوانند تیکت های ارسالی از کاربران سایت را خوانده و پاسخ مناسب را در قبال آنها ارائه دهند و سپس تیکت را ببندند.';
            $auth->add($ticketAuth);
            $auth->addChild($ticketAuth, $userIndex);
            $auth->addChild($ticketAuth, $userView);
            $auth->addChild($ticketAuth, $userCreate);
            $auth->addChild($ticketAuth, $TicketAdminClosed);
            $auth->addChild($ticketAuth, $userDelete);
            $auth->addChild($ticketAuth, $TicketAdminOpen);
            $auth->addChild($ticketAuth, $TicketAdminAnswer);

            $auth->addChild($adminManager, $userIndex);
            $auth->addChild($adminManager, $userView);
            $auth->addChild($adminManager, $userCreate);
            $auth->addChild($adminManager, $TicketAdminClosed);
            $auth->addChild($adminManager, $userDelete);
            $auth->addChild($adminManager, $TicketAdminOpen);
            $auth->addChild($adminManager, $TicketAdminAnswer);



        }
        //</TicketAdmin Controller>

        
        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($adminManager, 1);
    }
}