<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'user.view'],
            ['name' => 'user.create'],
            ['name' => 'user.update'],
            ['name' => 'user.delete'],

            ['name' => 'language.view'],
            ['name' => 'language.create'],
            ['name' => 'language.update'],
            ['name' => 'language.delete'],

            ['name' => 'role.view'],
            ['name' => 'role.create'],
            ['name' => 'role.update'],
            ['name' => 'role.delete'],

            ['name' => 'configuration.view'],
            ['name' => 'configuration.create'],
            ['name' => 'configuration.update'],
            ['name' => 'configuration.delete'],

            ['name' => 'customer.show'],
            ['name' => 'customer.saleView'],
            ['name' => 'customer.view'],
            ['name' => 'customer.create'],
            ['name' => 'customer.update'],
            ['name' => 'customer.delete'],

            ['name' => 'employe.show'],
            ['name' => 'employe.view'],
            ['name' => 'employe.create'],
            ['name' => 'employe.update'],
            ['name' => 'employe.delete'],
            ['name' => 'employe.purchase'],

            ['name' => 'employeAdsence.show'],
            ['name' => 'employeAdsence.view'],
            ['name' => 'employeAdsence.create'],
            ['name' => 'employeAdsence.list'],
            ['name' => 'employeAdsence.delete'],
            ['name' => 'employeAdsence.edit']

            ['name' => 'employeAttendees.show'],
            ['name' => 'employeAttendees.create'],
            ['name' => 'employeAttendees.view'],

            ['name' => 'employeDesignation.show'],
            ['name' => 'employeDesignation.create'],
            ['name' => 'employeDesignation.update'],
            ['name' => 'employeDesignation.delete'],

            ['name' => 'shiftTime.show'],
            ['name' => 'shiftTime.create'],
            ['name' => 'shiftTime.update'],
            ['name' => 'shiftTime.employeeList'],
            ['name' => 'shiftTime.delete'],


            ['name' => 'productItem.show'],
            ['name' => 'productItem.purchaseview'],
            ['name' => 'productItem.saleView'],
            ['name' => 'productItem.create'],
            ['name' => 'productItem.update'],
            ['name' => 'productItem.delete'],

            ['name' => 'productCompany.show'],
            ['name' => 'productCompany.view'],
            ['name' => 'productCompany.create'],
            ['name' => 'productCompany.update'],
            ['name' => 'productCompany.delete'],

            ['name' => 'productPurchase.show'],
            ['name' => 'productPurchase.invoice'],
            ['name' => 'productPurchase.view'],
            ['name' => 'productPurchase.create'],
            ['name' => 'productPurchase.update'],
            ['name' => 'productPurchase.delete'],
            ['name' => 'productPurchase.due'],

            ['name' => 'productSale.show'],
            ['name' => 'productSale.view'],
            ['name' => 'productSale.invoice'],
            ['name' => 'productSale.create'],
            ['name' => 'productSale.update'],
            ['name' => 'productSale.delete'],
            ['name' => 'productSale.due'],

            ['name' => 'salary.payShow'],
            ['name' => 'salary.pay'],

            ['name' => 'salarySetup.show'],
            ['name' => 'salarySetup.create'],
            ['name' => 'salarySetup.delete'],

            ['name' => 'expenseCategory.show'],
            ['name' => 'expenseCategory.create'],
            ['name' => 'expenseCategory.update'],
            ['name' => 'expenseCategory.delete'],

            ['name' => 'expense.show'],
            ['name' => 'expense.view'],
            ['name' => 'expense.create'],
            ['name' => 'expense.update'],
            ['name' => 'expense.delete'],

            ['name' => 'bank.show'],
            ['name' => 'bank.view'],
            ['name' => 'bank.create'],
            ['name' => 'bank.update'],
            ['name' => 'bank.delete'],
            ['name' => 'bank.withdraw'],
            ['name' => 'bank.deposit'],

            ['name' => 'incomeSourse.show'],
            ['name' => 'incomeSourse.create'],
            ['name' => 'incomeSourse.update'],
            ['name' => 'incomeSourse.delete'],

            ['name' => 'transaction.show'],
            ['name' => 'transaction.withdraw'],
            ['name' => 'transaction.deposit'],


            ['name' => 'accountBalance.show'],


            ['name' => 'report.show'],
            ['name' => 'report.productStock'],
            ['name' => 'report.productSale'],
            ['name' => 'report.companyPurchase'],
            ['name' => 'report.companySale'],
            ['name' => 'report.profitLoss'],
            ['name' => 'report.employSalary'],
            ['name' => 'report.dayBydayMonth'],
            
        ];

        $insert_data = [];
        $time_stamp = Carbon::now();
        foreach ($data as $d) {
            $d['guard_name'] = 'web';
            $d['created_at'] = $time_stamp;
            $insert_data[] = $d;
        }
        Permission::insert($insert_data);
    }
}
