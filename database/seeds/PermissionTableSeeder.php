<?php

use Illuminate\Database\Seeder;

use App\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                $permission = [

          [

            'name' => 'role-list',

            'display_name' => 'Display Role Listing',

            'description' => 'See only Listing Of Role'

          ],

          [

            'name' => 'role-create',

            'display_name' => 'Create Role',

            'description' => 'Create New Role'

          ],

          [

            'name' => 'role-edit',

            'display_name' => 'Edit Role',

            'description' => 'Edit Role'

          ],

          [

            'name' => 'role-delete',

            'display_name' => 'Delete Role',

            'description' => 'Delete Role'

          ],

          [

            'name' => 'item-list',

            'display_name' => 'Display Item Listing',

            'description' => 'See only Listing Of Item'

          ],

          [

            'name' => 'item-create',

            'display_name' => 'Create Item',

            'description' => 'Create New Item'

          ],

          [

            'name' => 'item-edit',

            'display_name' => 'Edit Item',

            'description' => 'Edit Item'

          ],

          [

            'name' => 'item-delete',

            'display_name' => 'Delete Item',

            'description' => 'Delete Item'

          ],

          [

            'name' => 'quotation-create',

            'display_name' => 'Create Quotation',

            'description' => 'Create Quotation'

          ],

          [

            'name' => 'quotation-edit',

            'display_name' => 'Edit Quotation',

            'description' => 'Edit Quotation'

          ],

          [

            'name' => 'quotation-delete',

            'display_name' => 'Delete Quotation',

            'description' => 'Delete Quotation'

          ],

          [

            'name' => 'order-create',

            'display_name' => 'Create Order',

            'description' => 'Create Order'

          ],

          [

            'name' => 'order-edit',

            'display_name' => 'Edit Order',

            'description' => 'Edit Order'

          ],

          [

            'name' => 'order-delete',

            'display_name' => 'Delete Order',

            'description' => 'Delete Order'

          ],

          [

            'name' => 'customer-create',

            'display_name' => 'Create Customer',

            'description' => 'Create Customer'

          ],

          [

            'name' => 'customer-edit',

            'display_name' => 'Edit Customer',

            'description' => 'Edit Customer'

          ],

          [

            'name' => 'customer-delete',

            'display_name' => 'Delete Customer',

            'description' => 'Delete Customer'

          ],

          [

            'name' => 'challan-create',

            'display_name' => 'Create Challan',

            'description' => 'Create Challan'

          ],

          [

            'name' => 'challan-edit',

            'display_name' => 'Edit Challan',

            'description' => 'Edit CChallan'

          ],

          [

            'name' => 'challan-delete',

            'display_name' => 'Delete Challan',

            'description' => 'Delete Challan'

          ]

        ];


        foreach ($permission as $key => $value) {

          Permission::create($value);

        }
    }
}
