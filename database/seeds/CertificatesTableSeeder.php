<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CertificatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	foreach (range(1, 100) as $index)
	{
        	DB::table('certificates')->insert([
			'user_id' => '1',
			'fqdn' => str_random(10).'.com',
			'memo' => str_random(100),
			'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
			'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	]);
	}
    }
}
