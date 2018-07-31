<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('links')->delete();
        
        \DB::table('links')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Mr. Buddy Balistreri',
                'link' => 'http://www.donnelly.info/',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Mr. Norris Hirthe II',
                'link' => 'http://www.pollich.net/fuga-ipsa-neque-qui-necessitatibus-nesciunt-cum.html',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'Sienna Schmeler',
                'link' => 'https://stracke.com/eum-blanditiis-autem-ea-reprehenderit-atque-pariatur-et.html',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'Alexane Boyer',
                'link' => 'http://www.aufderhar.com/a-vitae-temporibus-sunt-illum.html',
            ),
            4 => 
            array (
                'id' => 5,
                'title' => 'Garry Bins III',
                'link' => 'https://www.boyer.net/aut-temporibus-tenetur-quos-quia-quae-aspernatur-omnis',
            ),
        ));
        
        
    }
}