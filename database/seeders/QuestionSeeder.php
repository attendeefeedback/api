<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use Illuminate\Support\Str;
use Carbon\Carbon;


class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Question::insert([
            [
                'event_question' => 'In your opinion, what’s the best part of this session?',
                'canned_que' => 1,
                'event_id' => 1,
                'admin_id' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'event_question' => 'Is this session useful?',
                'canned_que' => 1,
                'event_id' => 1,
                'admin_id' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}       