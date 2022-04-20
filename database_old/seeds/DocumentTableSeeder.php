<?php

use Illuminate\Database\Seeder;
use App\Models\Document;
use Carbon\Carbon;
use Faker\Factory as Faker;

class DocumentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersTable =  DB::table('users')->inRandomOrder()->pluck('id')->toArray();
        $faker = Faker::create();

        $files = [
            [
                'name' => 'sample1',
                'url' => 'http://www.africau.edu/images/default/sample.pdf',
                'type' => 'pdf'

            ],
            [
                'name' => 'dummy-pdf',
                'url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
                'type' => 'pdf'

            ],
            [
                'name' => 'sampple-iamge',
                'url' => 'https://image.shutterstock.com/image-vector/sample-stamp-grunge-texture-vector-600w-1389188327.jpg',
                'type' => 'jpg'

            ],
            [
                'name' => 'invoice',
                'url' => 'https://templates.invoicehome.com/invoice-template-en-neat-750px.png',
                'type' => 'png'

            ],

        ];






        for($i = 1 ; $i < 20; $i++){
            $selected_file = $files[rand(0, 3)];
            $document =[
                'id' => $i,
                'user_id' =>  $faker->randomElement($usersTable),
                'name' => $selected_file['name'],
                'url' => $selected_file['url'],
                'file_type' => $selected_file['type'],
                'created_at'	=> Carbon::now(),
                'updated_at'	=> Carbon::now(),
            ];


            Document::create($document);
        }




    }

}
