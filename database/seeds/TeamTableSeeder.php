<?php

use Illuminate\Database\Seeder;

class TeamTableSeeder extends DatabaseSeeder {

    public function run()
    {
        $teams = [];
        $leagues = [1];
        $seasons = [1, 2, 3];
        $teams_name = [
          // Season 2012
          [
            'Jimbos Chiefs',
            'DjKFTW',
            'Team Ez',
            'LWSS',
            'Kansas City Chumps',
            'Hailvern',
            'THFC',
            'Gerald Siiiiiiiibon',
            'Wolverhampton Wasters',
            'Ha Noi Tigers',
          ],
          // Season 2013
          [
            'The Disciples of Juan Carlos',
            'Can\'t Stand the Heat',
            '21st and Hine',
            'The Ghost of Team Ez',
            'Kansas City Chumps',
            'Bush Johnson',
            'Team SMH Dollar Sign',
            'Gerald Siiiiiiiibon',
            'Wolverhampton Wasters',
            'Ha Noi Tigers',
          ],
          // Season 2014
          [
            'The Disciples of Juan Carlos',
            'Teach Me How To Dougie Martin',
            '21st and Hine',
            'The Vineyard',
            'Kansas City Chumps',
            'Bush Johnson',
            'Team SMH Dollar Sign',
            'Gerald Siiiiiiiibon',
            'Wolverhampton Wasters',
            'Ha Noi Tigers',
            'Suh Suh Sudio',
            'Manziels Two Headed Unicorn',
          ],
        ];
        $teams_man = [
          // season 2012
          [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
          // season 2013
          [12, 2, 11, 4, 5, 6, 7, 8, 9, 10],
          // season 2014
          [12, 2, 11, 4, 5, 6, 7, 8, 9, 10, 13, 14],
        ];

        for ($i=0; $i < count($leagues); $i++)
        {
          for($j=0; $j < count($seasons); $j++)
          {
            for ($k=0; $k < count($teams_name[$j]); $k++)
            {
              $teams[] = [
                'league_id' => $leagues[$i],
                'season_id' => $seasons[$j],
                'name' => $teams_name[$j][$k],
                'manager_id' => $teams_man[$j][$k],
                'position' => $k,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
              ];
            }
          }
        }


        DB::table('teams')->insert($teams);
    }

}
