<?php

namespace Database\Seeders;

use App\Models\Api\Core\Wilaya;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Wilayas extends Seeder
{
    public $wilayas = [
        'Adrar',
        'Chlef',
        'Laghouat',
        'Oum El Bouaghi',
        'Batna',
        'Béjaïa',
        'Biskra',
        'Béchar',
        'Blida',
        'Bouira',
        'Tamanrasset',
        'Tébessa',
        'Tlemcen',
        'Tiaret',
        'Tizi Ouzou',
        'Algiers',
        'Djelfa',
        'Jijel',
        'Sétif',
        'Saïda',
        'Skikda',
        'Sidi Bel Abbès',
        'Annaba',
        'Guelma',
        'Constantine',
        'Médéa',
        'Mostaganem',
        'M\'Sila',
        'Mascara',
        'Ouargla',
        'Oran',
        'El Bayadh',
        'Illizi',
        'Bordj Bou Arréridj',
        'Boumerdès',
        'El Tarf',
        'Tindouf',
        'Tissemsilt',
        'El Oued',
        'Khenchela',
        'Souk Ahras',
        'Tipaza',
        'Mila',
        'Aïn Defla',
        'Naâma',
        'Aïn Témouchent',
        'Ghardaïa',
        'Relizane',
        'Timimoun',
        'Bordj Badji Mokhtar',
        'Ouled Djellal',
        'Béni Abbès',
        'In Salah',
        'In Guezzam',
        'Touggourt',
        'Djanet',
        'El M\'Ghair',
        'El Meniaa',
    ];

    public function run(): void
    {
        foreach ($this->wilayas as $wilaya) {
            $w = Wilaya::create([
                'name' => $wilaya
            ]);
            $w->baladiyas()->create([
                'name' => $wilaya
            ]);
        }
    }
}
