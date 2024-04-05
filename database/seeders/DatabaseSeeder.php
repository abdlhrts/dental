<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\DentalCondition;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $kondisi_gigi = [
            ['code' => 'sou', 'name' => 'sound'],
            ['code' => 'non', 'name' => 'no information'],
            ['code' => 'une', 'name' => 'unerupted'],
            ['code' => 'pre', 'name' => 'present'],
            ['code' => 'imx', 'name' => 'impacted non-visible'],
            ['code' => 'ano', 'name' => 'anomali'],
            ['code' => 'dia', 'name' => 'diastema'],
            ['code' => 'abr', 'name' => "abr"],
            ['code' => 'car', 'name' => 'caries'],
            ['code' => 'cfr', 'name' => 'crown fractured'],
            ['code' => 'nvt', 'name' => 'non-vital tooth'],
            ['code' => 'rrx', 'name' => 'retained root'],
            ['code' => 'mis', 'name' => 'missing'],
            ['code' => 'att', 'name' => 'attrition'],
            ['code' => 'amf', 'name' => 'amalgam filling'],
            ['code' => 'gif', 'name' => 'glass ionomer filling'],
            ['code' => 'cof', 'name' => "cof"],
            ['code' => 'fis', 'name' => 'fissure sealant'],
            ['code' => 'inl', 'name' => 'inlay'],
            ['code' => 'onl', 'name' => 'onlay'],
            ['code' => 'fmc', 'name' => 'full metal crown'],
            ['code' => 'poc', 'name' => 'porcelain crown'],
            ['code' => 'mpc', 'name' => 'metal porcelain crown'],
            ['code' => 'gmc', 'name' => 'gold metal crown'],
            ['code' => 'rct', 'name' => 'root canal treatment'],
            ['code' => 'ipx', 'name' => 'implant'],
            ['code' => 'meb', 'name' => 'metal bridge'],
            ['code' => 'pob', 'name' => 'porcelain bridge'],
            ['code' => 'pon', 'name' => 'pontic'],
            ['code' => 'abu', 'name' => 'abutment']
        ];
        DB::table('dental_conditions')->insert($kondisi_gigi);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
