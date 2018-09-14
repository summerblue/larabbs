<?php

use Illuminate\Database\Seeder;

class MigrationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('migrations')->delete();
        
        \DB::table('migrations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'migration' => '2018_09_14_142237_create_categories_table',
                'batch' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'migration' => '2018_09_14_142237_create_failed_jobs_table',
                'batch' => 0,
            ),
            2 => 
            array (
                'id' => 3,
                'migration' => '2018_09_14_142237_create_images_table',
                'batch' => 0,
            ),
            3 => 
            array (
                'id' => 4,
                'migration' => '2018_09_14_142237_create_links_table',
                'batch' => 0,
            ),
            4 => 
            array (
                'id' => 5,
                'migration' => '2018_09_14_142237_create_model_has_permissions_table',
                'batch' => 0,
            ),
            5 => 
            array (
                'id' => 6,
                'migration' => '2018_09_14_142237_create_model_has_roles_table',
                'batch' => 0,
            ),
            6 => 
            array (
                'id' => 7,
                'migration' => '2018_09_14_142237_create_notifications_table',
                'batch' => 0,
            ),
            7 => 
            array (
                'id' => 8,
                'migration' => '2018_09_14_142237_create_password_resets_table',
                'batch' => 0,
            ),
            8 => 
            array (
                'id' => 9,
                'migration' => '2018_09_14_142237_create_permissions_table',
                'batch' => 0,
            ),
            9 => 
            array (
                'id' => 10,
                'migration' => '2018_09_14_142237_create_replies_table',
                'batch' => 0,
            ),
            10 => 
            array (
                'id' => 11,
                'migration' => '2018_09_14_142237_create_revisions_table',
                'batch' => 0,
            ),
            11 => 
            array (
                'id' => 12,
                'migration' => '2018_09_14_142237_create_role_has_permissions_table',
                'batch' => 0,
            ),
            12 => 
            array (
                'id' => 13,
                'migration' => '2018_09_14_142237_create_roles_table',
                'batch' => 0,
            ),
            13 => 
            array (
                'id' => 14,
                'migration' => '2018_09_14_142237_create_topics_table',
                'batch' => 0,
            ),
            14 => 
            array (
                'id' => 15,
                'migration' => '2018_09_14_142237_create_users_table',
                'batch' => 0,
            ),
            15 => 
            array (
                'id' => 16,
                'migration' => '2018_09_14_142239_add_foreign_keys_to_model_has_permissions_table',
                'batch' => 0,
            ),
            16 => 
            array (
                'id' => 17,
                'migration' => '2018_09_14_142239_add_foreign_keys_to_model_has_roles_table',
                'batch' => 0,
            ),
            17 => 
            array (
                'id' => 18,
                'migration' => '2018_09_14_142239_add_foreign_keys_to_replies_table',
                'batch' => 0,
            ),
            18 => 
            array (
                'id' => 19,
                'migration' => '2018_09_14_142239_add_foreign_keys_to_role_has_permissions_table',
                'batch' => 0,
            ),
            19 => 
            array (
                'id' => 20,
                'migration' => '2018_09_14_142239_add_foreign_keys_to_topics_table',
                'batch' => 0,
            ),
        ));
        
        
    }
}