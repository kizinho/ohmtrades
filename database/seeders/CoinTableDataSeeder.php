<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Coin;

class CoinTableDataSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $coin = new Coin();
        $coin->name = 'Bitcoin';
        $coin->slug = str_slug('Bitcoin Address', '_');
        $coin->address = 'dsdjhdjhdhjhhrhejhdjhje';
        $coin->status = true;
        $coin->photo = 'coins/bitcoin_address.png';
        $coin->save();
////        //coin 2
//        $coin2 = new Coin();
//        $coin2->name = 'Litecoin';
//        $coin2->slug = str_slug('Litecoin Address', '_');
//        $coin2->address = 'Ltdsdjhdjhdhjhhrhejhdjhje';
//        $coin2->status = true;
//        $coin2->photo = 'coins/litecoin_address.png';
//        $coin2->save();
//        //coin 3
        $coin3 = new Coin();
        $coin3->name = 'Ethereum';
        $coin3->slug = str_slug('Ethereum Address', '_');
        $coin3->address = 'Ethudsdjhdjhdhjhhrhejhdjhje';
        $coin3->status = true;
        $coin3->photo = 'coins/ethereum_address.png';
        $coin3->save();
//        //coin 4
//        $coin4 = new Coin();
//        $coin4->name = 'Bitcoin Cash';
//        $coin4->slug = str_slug('Bitcoin Cash Address', '_');
//        $coin4->address = 'Btccdsdjhdjhdhjhhrhejhdjhje';
//        $coin4->status = true;
//        $coin4->photo = 'coins/bitcoin_cash_address.png';
//        $coin4->save();
//        //coin 5
//        $coin5 = new Coin();
//        $coin5->name = 'Dash';
//        $coin5->slug = str_slug('Dash Address', '_');
//        $coin5->address = 'ashhhdsdjhdjhdhjhhrhejhdjhje';
//        $coin5->status = true;
//        $coin5->photo = 'coins/dash_address.png';
//        $coin5->save();

//        $coin6 = new Coin();
//        $coin6->name = 'FlutterWave';
//        $coin6->slug = str_slug('flutter wave', '_');
//        $coin6->address = 'ashhhdsdjhdjhdhjhhrhejhdjhje';
//        $coin6->status = true;
//        $coin6->photo = 'images/dash.png';
//        $coin6->save();
    }

}
