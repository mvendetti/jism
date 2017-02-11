<?php

use Illuminate\Database\Seeder;

class KeysTableHero4Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->getRaw();
        foreach($data as $row)
        {
            DB::table('keys')->insert($row);
        }
    }

    public function getRaw()
    {
        return [
            [
                'model_number' => 13,
                'keytype' => 'status',
                'slug' => 'internal_battery',
                'gopro_id' => 1,
                'value' => 'Internal Battery',
                'datatype' => 'opts',
                'opts' => '{"0":"Not Installed","1":"Installed"}'
            ],
            [
                'model_number' => 13,
                'keytype' => 'status',
                'slug' => 'internal_batter_level',
                'gopro_id' => 2,
                'value' => 'Internal Battery Level',
                'datatype' => 'opts',
                'opts' => '{"3":"Full","2":"Half","1":"Low","4":"Charging"}'
            ],
            [
                'model_number' => 13,
                'keytype' => 'status',
                'slug' => 'current_mode',
                'gopro_id' => 43,
                'value' => 'Current Mode',
                'datatype' => 'opts',
                'opts' => '{"0":"Video","1":"Photo","2":"Multishot"}'
            ],
            [
                'model_number' => 13,
                'keytype' => 'status',
                'slug' => 'current_submode',
                'gopro_id' => 44,
                'value' => 'Current Submode',
                'datatype' => 'opts',
                'opts' => '{"0":"Video/Single/Burst","1":"Video/Continuous/TimeLapse","2":"Video+Photo/NightPhoto/NightLapse"}'
            ],
            [
                'model_number' => 13,
                'keytype' => 'status',
                'slug' => 'current_video_duration',
                'gopro_id' => 13,
                'datatype' => 'integer',
                'value' => 'Current Recording Video Duration',
            ],
            [
                'model_number' => 13,
                'keytype' => 'status',
                'slug' => 'current_multishot_pictures',
                'gopro_id' => 39,
                'datatype' => 'integer',
                'value' => 'Number of MultiShot pictures taken',
            ],
            [
                'model_number' => 13,
                'keytype' => 'status',
                'slug' => 'clients_connected',
                'gopro_id' => 31,
                'datatype' => 'integer',
                'value' => 'Number of clients connected',
            ],
            [
                'model_number' => 13,
                'keytype' => 'status',
                'slug' => 'streaming_feed_status',
                'gopro_id' => 32,
                'value' => 'Streaming Feed Status',
                'datatype' => 'opts',
                'opts' => '{"0":"Offline","2":"Streaming"}'
            ],
            [
                'model_number' => 13,
                'keytype' => 'status',
                'slug' => 'card_inserted',
                'gopro_id' => 33,
                'value' => 'SD card inserted',
                'datatype' => 'opts',
                'opts' => '{"0":"Yes","2":"No"}'
            ],
            [
                'model_number' => 13,
                'keytype' => 'status',
                'slug' => 'remaining_photos',
                'gopro_id' => 34,
                'value' => 'Remaining Photos',
                'datatype' => 'integer'
            ],
            [
                'model_number' => 13,
                'keytype' => 'status',
                'slug' => 'remaining_video_duration',
                'gopro_id' => 35,
                'value' => 'Remaining Video Time',
                'datatype' => 'integer'
            ],
            [
                'model_number' => 13,
                'keytype' => 'status',
                'slug' => 'current_batch_photos',
                'gopro_id' => 36,
                'value' => 'Number of Batch Photos Taken',
                'datatype' => 'integer'
            ],
            [
                'model_number' => 13,
                'keytype' => 'status',
                'slug' => 'videos_taken',
                'gopro_id' => 37,
                'value' => 'Number of videos taken',
                'datatype' => 'integer'
            ],
            [
                'model_number' => 13,
                'keytype' => 'status',
                'slug' => 'photos_taken',
                'gopro_id' => 38,
                'value' => 'Number of ALL photos taken',
                'datatype' => 'integer'
            ],
            [
                'model_number' => 13,
                'keytype' => 'status',
                'slug' => 'all_videos_taken',
                'gopro_id' => 39,
                'value' => 'Number of ALL videos taken',
                'datatype' => 'integer'
            ],
            [
                'model_number' => 13,
                'keytype' => 'status',
                'slug' => 'recording_status',
                'gopro_id' => 8,
                'value' => 'Recording Status',
                'datatype' => 'opts',
                'opts' => '{"0":"Not Recording","1":"Recording"}'
            ]
        ];
    }
}
