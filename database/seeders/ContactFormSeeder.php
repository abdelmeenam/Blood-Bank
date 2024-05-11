<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;
use App\Models\ContactForm;

class ContactFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define sample data
        $data = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'message' => 'Hello, I am interested in your product.',
                'phone' => '1234567890',
                'subject' => 'Product Inquiry',
            ]
        ];

        // loop to insert  10 records
        for ($i = 0; $i < 10; $i++) {

            Contact::create([
                'name' => $data[0]['name'],
                'email' => $data[0]['email'],
                'message' => $data[0]['message'],
                'phone' => $data[0]['phone'],
                'subject' => $data[0]['subject'],
            ]);
        }
    }

    //php artisan db:seed --class=ContactFormSeeder

}