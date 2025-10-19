<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Contact;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Contact::factory()->count(35)->create();
        try {
            Contact::factory(35)->create();
            $this->command->info('✅ Contact dummy data seeded successfully!');
        } catch (\Throwable $e) {
            $this->command->error('❌ Error: ' . $e->getMessage());
        }
    }
}
