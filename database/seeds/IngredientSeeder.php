<?php


use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = \Elasticsearch\ClientBuilder::create()
            ->setHosts(['http://localhost:9200'])
            ->build();

        $ingredient = [
            'Acar','Apel','Adpokat','Anggur',
            'Bawang Putih','Beras','Buah Zaitun','Beras Merah','Bawang Bombai','Buah Kering','Bakso Daging','Bayam','Biet','Buncis','Bunga Kol','Belimbing',
            'Cabai Merah','Cuka','Cabe Hijau',
            'Daun Jeruk','Daun Herbal Kering','Daging Sapi','Daging Babi','Daging Ayam','Daun Bawang','Daun Bluntas','Daun Kecipir','Daun Koro',
            'Daun Labu Siam','Daun Leunca','Daun Lobak','Daun Melinjo','Daun Pakis','Daun Pepaya','Daun Singkong','Daun Talas','Daun Ubi','Daun Waluh',
            'Duku','Durian',
            'Gula Pasir','Gula Merah','Garam Laut','Genjer',
            'Havermut',
            'Iga Kambing','Ikan Teri','Ikan Asin','Ikan Segar',
            'Jinten','Jahe','Jamur','Jagung Muda','Jantung Pisang','Jambu Biji','Jambu Air','Jambu Bol','Jeruk Manis',
            'Kecap Asin','Kecap Inggris','Kecap Manis','Keju','Kentang','Kacang','Kacang Panjang','Kacang Ijo','Kacang Kedelai','Kacang Merah',
            'Kangkung','Katuk','Kecipir','Ketimun','Kool','Kucai','Kedondong','Kemang','Keju','Kelapa','Kelapa Parut',
            'Lada Hitam','Lemon','Labu Siam','Labu Waluh','Lobak','Lemak Sapi','Lemak Babi',
            'Minyak Wijen','Mustard','Madu','Mayonais','Mangga','Melon','Minyak Kacang','Minyak Goreng','Minyak Ikan','Margarin',
            'Nasi','Nangka Muda','Nangka Masak','Nanas',
            'Oyong',
            'Pare','Pecay','Pepaya Muda','Pepaya','Pisang Ambon','Pisang Raja Sereh',
            'Roti Gandum','Rebung','Rambutan',
            'Saus Tomat','Sawi','Selada','Seledri','Salak','Sawo','Sirsak','Semangka','Susu Sapi','Susu Kambing','Susu Kerbau','Susu Kental Tak Manis','Santan',
            'Telur','Tomat','Taoge','Tebu Terubuk','Tekokak','Terong','Tepung Susu','Tepung Saridele',
            'Udang',
            'Wortel',
            'Yogurt'
        ];

        for($i=0;$i<count($ingredient);$i++){
            $params = [
                'index' => 'ingredient',
                'type'  => 'ingredient',
                'id'    => $i,
                'body'  => [
                    'name'        => $ingredient[$i],
                ]
            ];

            $client->index($params);
        }
    }
}