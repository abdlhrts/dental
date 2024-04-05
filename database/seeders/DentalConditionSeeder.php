<?php

namespace Database\Seeders;

use App\Models\DentalCondition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DentalConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $kondisi_gigi = array(
            array('code' => 'sou', 'name' => 'sound'),
            array('code' => 'non', 'name' => 'no information'),
            array('code' => 'une', 'name' => 'unerupted'),
            array('code' => 'pre', 'name' => 'present'),
            array('code' => 'imx', 'name' => 'impacted non-visible'),
            array('code' => 'ano', 'name' => 'anomali'),
            array('code' => 'dia', 'name' => 'diastema'),
            array('code' => 'abr', 'name' => "abr"),
            array('code' => 'car', 'name' => 'caries'),
            array('code' => 'cfr', 'name' => 'crown fractured'),
            array('code' => 'nvt', 'name' => 'non-vital tooth'),
            array('code' => 'rrx', 'name' => 'retained root'),
            array('code' => 'mis', 'name' => 'missing'),
            array('code' => 'att', 'name' => 'attrition'),
            array('code' => 'amf', 'name' => 'amalgam filling'),
            array('code' => 'gif', 'name' => 'glass ionomer filling'),
            array('code' => 'cof', 'name' => "cof"),
            array('code' => 'fis', 'name' => 'fissure sealant'),
            array('code' => 'inl', 'name' => 'inlay'),
            array('code' => 'onl', 'name' => 'onlay'),
            array('code' => 'fmc', 'name' => 'full metal crown'),
            array('code' => 'poc', 'name' => 'porcelain crown'),
            array('code' => 'mpc', 'name' => 'metal porcelain crown'),
            array('code' => 'gmc', 'name' => 'gold metal crown'),
            array('code' => 'rct', 'name' => 'root canal treatment'),
            array('code' => 'ipx', 'name' => 'implant'),
            array('code' => 'meb', 'name' => 'metal bridge'),
            array('code' => 'pob', 'name' => 'porcelain bridge'),
            array('code' => 'pon', 'name' => 'pontic'),
            array('code' => 'abu', 'name' => 'abutment')
        );
        DentalCondition::create($kondisi_gigi);
    }
}
