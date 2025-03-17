<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        
        DB::table('licenses')->insert(
            [
                [
                    'id' => 1,
                    'api' => 'rtlead27bc21537fdcb11b3b340a53242',
                    'product_id' => '237185',
                    'order_id' => '',
                    'domain' => '',
                    'username' => ''
                ]
            ]
        );


        DB::table('permissions')->insert(
            [
                [
                    'id' => 1,
                    'title' => 'brands',
                    'description' => 'برند ها',
                    'isActive' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'id' => 2,
                    'title' => 'units',
                    'description' => 'واحد ها',
                    'isActive' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'id' => 3,
                    'title' => 'categories',
                    'description' => 'دسته بندی ها',
                    'isActive' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'id' => 4,
                    'title' => 'stores',
                    'description' => 'انبار ها',
                    'isActive' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'id' => 5,
                    'title' => 'permissions',
                    'description' => 'سطح دسترسی ها',
                    'isActive' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'id' => 6,
                    'title' => 'roles',
                    'description' => 'نقش ها',
                    'isActive' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'id' => 7,
                    'title' => 'users',
                    'description' => 'کاربران سیستم',
                    'isActive' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'id' => 8,
                    'title' => 'employees',
                    'description' => 'پرسنل',
                    'isActive' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'id' => 9,
                    'title' => 'entities',
                    'description' => 'موجودی ها',
                    'isActive' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'id' => 10,
                    'title' => 'end-product',
                    'description' => 'کالاهای تمام شده',
                    'isActive' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'id' => 11,
                    'title' => 'deliveries',
                    'description' => 'تحویل کالا',
                    'isActive' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'id' => 12,
                    'title' => 'stocks',
                    'description' => 'مدیریت کالای دست دوم',
                    'isActive' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

                [
                    'id' => 13,
                    'title' => 'invoices',
                    'description' => 'لیست فاکتور',
                    'isActive' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'id' => 14,
                    'title' => 'invoice-add',
                    'description' => 'ثبت فاکتور جدید',
                    'isActive' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'id' => 15,
                    'title' => 'invoice-product-list',
                    'description' => 'لیست اقلام خریداری شده',
                    'isActive' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'id' => 16,
                    'title' => 'product-add',
                    'description' => 'ثبت کالای جدید',
                    'isActive' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'id' => 17,
                    'title' => 'products',
                    'description' => 'لیست کالا ها',
                    'isActive' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'id' => 18,
                    'title' => 'organizations',
                    'description' => 'تعریف سازمان',
                    'isActive' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'id' => 19,
                    'title' => 'logs',
                    'description' => 'گزارشات سیستم',
                    'isActive' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'id' => 20,
                    'title' => 'abortions',
                    'description' => 'کالاهای اسقاطی',
                    'isActive' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'id' => 21,
                    'title' => 'transfers',
                    'description' => 'انتقال انبار به انبار',
                    'isActive' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'id' => 22,
                    'title' => 'reports',
                    'description' => 'گزارش مدیر',
                    'isActive' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'id' => 23,
                    'title' => 'histories',
                    'description' => 'تاریخچه موجودی ها',
                    'isActive' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'id' => 24,
                    'title' => 'repairs',
                    'description' => 'بخش تعمیرات',
                    'isActive' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'id' => 25,
                    'title' => 'settings',
                    'description' => 'بخش تنظیمات',
                    'isActive' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'id' => 26,
                    'title' => 'report-warehouse',
                    'description' => 'گزارش جامع انبار',
                    'isActive' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

            ]

        );

        DB::table('organizations')->insert(
            [
                [
                    'title' => 'سازمان یک',
                    'description' => 'سازمان یک',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => 'سازمان دو',
                    'description' => 'سازمان دو',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => 'سازمان سه',
                    'description' => 'سازمان سه',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]
        );

        DB::table('units')->insert(
            [
                [
                    'title' => 'واحد منابع انسانی',
                    'organization_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => 'واحد فناوری اطلاعات',
                    'organization_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => 'واحد مالی',
                    'organization_id' => 3,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]
        );

        DB::table('categories')->insert(
            [
                [
                    'title' => 'مانیتور',
                    'parent_id' => null,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => 'مانیتور 24 اینچ',
                    'parent_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => 'پرینتر',
                    'parent_id' => null,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => 'ماوس',
                    'parent_id' => null,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]
        );

        DB::table('brands')->insert(
            [
                [
                    'title' => 'سامسونگ',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => 'ال جی',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => 'جی پلاس',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]
        );

        DB::table('stores')->insert(
            [
                [
                    'title' => 'انبار کالا',
                    'organization_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => 'انبار تعمیرات',
                    'organization_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => 'انبار لوازم و قطعات',
                    'organization_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]
        );

        DB::table('roles')->insert(
            [
                [
                    'id' => 1,
                    'title' => 'admin',
                    'description' => 'مدیریت',
                    'isActive' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'id' => 2,
                    'title' => 'expert',
                    'description' => 'کارشناس سامانه',
                    'isActive' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ],

            ]
        );

        foreach (Permission::all() as $permission) {
            DB::table('permission_role')->insert(
                [
                    [
                        'permission_id' => $permission->id,
                        'role_id' => 1,
                    ],
                ]
            );
        }

        DB::table('permission_role')->insert(
            [
                [
                    'permission_id' => 11,
                    'role_id' => 2,
                ],
                [
                    'permission_id' => 2,
                    'role_id' => 2,
                ],
                [
                    'permission_id' => 8,
                    'role_id' => 2,
                ],

                [
                    'permission_id' => 12,
                    'role_id' => 2,
                ],

                [
                    'permission_id' => 13,
                    'role_id' => 2,
                ],

                [
                    'permission_id' => 14,
                    'role_id' => 2,
                ],

                [
                    'permission_id' => 15,
                    'role_id' => 2,
                ],

                [
                    'permission_id' => 16,
                    'role_id' => 2,
                ],

                [
                    'permission_id' => 17,
                    'role_id' => 2,
                ],

                [
                    'permission_id' => 20,
                    'role_id' => 2,
                ],
                [
                    'permission_id' => 21,
                    'role_id' => 2,
                ],
                [
                    'permission_id' => 24,
                    'role_id' => 2,
                ],
            ]
        );

        DB::table('role_store')->insert(
            [
                [
                    'role_id' => 1,
                    'store_id' => 1,
                ],
                [
                    'role_id' => 1,
                    'store_id' => 2,
                ],
                [
                    'role_id' => 1,
                    'store_id' => 3,
                ],
                [
                    'role_id' => 2,
                    'store_id' => 2,
                ],
            ]
        );

        DB::table('users')->insert(
            [
                [
                    'created_at' => now(),
                    'updated_at' => now(),
                    'name' => "مدیریت",
                    'email' => "admin@almas.com",
                    'password' => bcrypt('admin'),
                    'personalID' => '1400042295',
                    'organization_id' => 1,
                    'isActive' => 1,
                    'isAdmin' => 1,
                ],
                [
                    'created_at' => now(),
                    'updated_at' => now(),
                    'name' => "کارشناس",
                    'email' => "user@almas.com",
                    'password' => bcrypt('user'),
                    'personalID' => '97102014',
                    'organization_id' => 2,
                    'isActive' => 1,
                    'isAdmin' => 1,
                ],
            ]
        );

        DB::table('role_user')->insert(
            [
                [
                    'role_id' => 1,
                    'user_id' => 1,
                ],
                [
                    'role_id' => 1,
                    'user_id' => 2,
                ],
            ]
        );

        DB::table('employees')->insert(
            [
                [
                    'name' => 'کارمند یک',
                    'parentUnit_id' => 2,
                    'organization_id' => 2,
                ],
                [
                    'name' => 'کارمند دو',
                    'parentUnit_id' => 1,
                    'organization_id' => 1,
                ],
            ]
        );

        DB::table('settings')->insert(
            [
                [
                    'title' => 'sms',
                    'value' => 'no',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => 'sms-panel',
                    'value' => 'ippanel',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => 'sms-user',
                    'value' => '',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => 'sms-password',
                    'value' => '',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => 'logo',
                    'value' => '/img/core-img/logo.png',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => 'user-register',
                    'value' => 'yes',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => 'login-banner',
                    'value' => '/img/bg-img/1.png',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => 'payment',
                    'value' => 'zarinpal',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => 'merchant-code',
                    'value' => '',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'title' => 'fav',
                    'value' => '/img/core-img/favicon.png',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]
        );
    }
}
