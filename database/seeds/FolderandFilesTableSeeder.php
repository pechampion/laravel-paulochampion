<?php

use Illuminate\Database\Seeder;

class FolderandFilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncating existing records to start from scratch
        \App\Folder::truncate();
        \App\Files::truncate();

        /**
         * Populating Database for Test
         *
         * $u means user_id (10) => Created on UsesTableSeeder
         * $d means folder_id (*10 =  100)
         * $f means folder_id (*10 =  1000)
         */

        // Creating 100 Folders and 1000 Files
        $faker = \Faker\Factory::create();

        for ($u = 1; $u <= 10; $u++) {
            // Seeding Folders (10 per User)
            for ($d = 0; $d <= 10; $d++) {
                \App\Folder::create([
                    'name' => $faker->word,
                    'sub_id' => $d,
                    'user_id' => $u,
                ]);
                // Seeding Files (10 per Folder)
                for ($f = 0; $f < 10; $f++) {
                    $filename = $faker->word.'.'.$faker->fileExtension;
                    $hash = md5($filename);
                    /* In order to have a physical file for download test:
                     * remove the comment bellow and run artisan seed as su
                     * command to run: "sudo php artisan db:seed"
                     */
                    // fopen(storage_path().'/app/usr/'.$hash,'w');

                    \App\Files::create([
                        'name' => $filename,
                        'folder_id' => $d,
                        'user_id' => $u,
                        'size' => $faker->numberBetween(100,1024000),
                        'path' => $hash,
                    ]);
                }
            }
        }
    }
}
