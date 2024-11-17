<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Load jobs from file
        $jobListings = include database_path('seeders/data/job_listings.php');

        // Get user ids from model
        $userIds = User::pluck('id')->toArray();

        // we will use & to replace in original array
        foreach($jobListings as &$listing) {
            // Assign user id to listing
            $listing['user_id'] = $userIds[array_rand($userIds)];

            // add timestamps
            $listing['created_at'] = now();
            $listing['updated_at'] = now();
        }
        
        DB::table('job_listings')->insert($jobListings);
        echo 'Jobs created succesfully';
    }
}