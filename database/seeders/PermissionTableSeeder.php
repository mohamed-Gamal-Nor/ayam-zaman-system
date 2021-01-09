<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
    public function run()
    {
        $permissions = [
            //الصلاحيات
            'قائمة الصلاحيات',
            'عرض صلاحية',
            'تعديل صلاحية',
            'حذف صلاحية',
            'اضافة صلاحية',
            //الموظفين
            'الموظفين',
            'قائمةالموظفين',
            'أضافة موظف',
            'تعديل موظف',
            'حذف موظف',
            'عرض موظف',
            'موظفين محذوفين',
            //العملاء
            'العملاء',
            'قائمةالعملاء',
            'اضافةعميل',
            'تعديل عميل',
            'حذف عميل',
            'عملاء محذوفين',

            //
            'تصديرأكسيل',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}