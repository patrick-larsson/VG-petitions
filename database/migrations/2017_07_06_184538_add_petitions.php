<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPetitions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Disclaimer: I found these at http://www.eonline.com/news/553877/the-18-most-ridiculous-and-unnecessary-online-petitions-ever

        $petitions = [
            [
                'name' => 'Petition for a Sarcasm Font on Social Media Sites',
                'description' => 'Have you ever tried to make a joke in an internet conversation and the recipient stopped talking to you for a week thereafter? Be one of the causes for what could be a revolution in instant messaging for everyone on the planet',
            ],
            [
                'name' => 'Ban Sporks',
                'description' => 'Please sign my petition to ban the absolutely eeevvviiilll SPORK keep it away from all decent americans and believe it or not I have heard of a spoonula too!!!!',
            ],
            [
                'name' => 'Bring Back S Club 7!!!',
                'description' => 'The most amazing bubble gum pop band to come out of the UK in 1999 needs to make a comeback, and only through a groundswell of public support will they take a break from their lives of relative mediocrity and return to stardom. If BSB and NKOTB can do it, so can S Club 7!!',
            ]
        ];

        // For fake data we could use a faker lib, but there aren't that many to do manually
        $entries = [
            [
                'petition_id' => 1,
                'first_name' => 'Kalle',
                'last_name' => 'Johnsson',
                'gender' => 'm',
                'email' => 'Kalle-Johnsson@gmail.com',
            ],
            [
                'petition_id' => 1,
                'first_name' => 'Jenny',
                'last_name' => 'Nilsson',
                'gender' => 'f',
                'email' => 'Jenny-Nilsson@gmail.com',
            ],
            [
                'petition_id' => 1,
                'first_name' => 'Nils',
                'last_name' => 'Svensson',
                'gender' => 'm',
                'email' => 'Nils-Svensson@gmail.com',
            ],
            [
                'petition_id' => 2,
                'first_name' => 'Patrick',
                'last_name' => 'Larsson',
                'gender' => 'm',
                'email' => 'Patrick-Larsson@gmail.com',
            ],
            [
                'petition_id' => 2,
                'first_name' => 'Andreas',
                'last_name' => 'Andreasson',
                'gender' => 'm',
                'email' => 'Andreas-Andreasson@gmail.com',
            ],
            [
                'petition_id' => 3,
                'first_name' => 'Niklas',
                'last_name' => 'Andersson',
                'gender' => 'm',
                'email' => 'Niklas-Andersson@gmail.com',
            ],
            [
                'petition_id' => 3,
                'first_name' => 'Sara',
                'last_name' => 'Persson',
                'gender' => 'f',
                'email' => 'Sara-Persson@gmail.com',
            ],
        ];

        DB::table('petitions')->insert($petitions);
        DB::table('petitions_entries')->insert($entries);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('petitions')->delete();
        DB::table('petitions_entries')->delete();
    }
}
