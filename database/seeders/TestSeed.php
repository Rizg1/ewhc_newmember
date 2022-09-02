<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class TestSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Basic 5',],
            ['id' => 2, 'name' => 'Drug Test',],
            ['id' => 3, 'name' => 'Hepa B',],
            ['id' => 4, 'name' => 'Anti Hbs',],
            ['id' => 5, 'name' => 'FA with Occult Blood',],
            ['id' => 6, 'name' => 'FBS',],
            ['id' => 7, 'name' => 'Bun',],
            ['id' => 8, 'name' => 'Crea',],
            ['id' => 9, 'name' => 'BUA',],
            ['id' => 10, 'name' => 'T. Cholesterol',],
            ['id' => 11, 'name' => 'Triglycerides',],
            ['id' => 12, 'name' => 'HDL/LDL, VLDL',],
            ['id' => 13, 'name' => 'SGPT',],
            ['id' => 14, 'name' => 'SGOT',],
            ['id' => 15, 'name' => 'SAGO',],



        ];

        foreach ($items as $item) {
            \App\Test::create($item);
        }
    }
}
