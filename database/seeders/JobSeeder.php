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
        //Load job listings from the file
        $jobListings = include database_path('seeders/data/job_listings.php');

        //Get user ids from user model
        $userIds = User::pluck('id')->toArray();

        //we use "&" as a reference which means we directly effect the original array
        foreach($jobListings as &$listing) {
            // Assign user id to listing
            $listing['user_id'] = $userIds[array_rand($userIds)];

            // Add timestamps
            $listing['created_at'] = now();
            $listing['updated_at'] = now();
        }

        // Insert job listings into DB
        DB::table('job_listings')->insert($jobListings);
        echo "Jobs created successfully!";
    }
}
