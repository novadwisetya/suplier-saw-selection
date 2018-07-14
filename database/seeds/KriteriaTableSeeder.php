<?php

use Illuminate\Database\Seeder;

class KriteriaTableSeeder extends Seeder
{

	protected $kriteria=[
	    0 => [
	      'kriteria' => 'Harga',
	      'bobot' => 0.281,
	      'keterangan' => 'cost',
	      'child' => [
	      		0 => [
	      			'sub_kriteria' => '<= 31000',
	      			'nilai' => 1,
	      			'kriteria_nilai' => 'Sangat Diutamakan'
	      		],
	      		1 => [
	      			'sub_kriteria' => '<= 35000',
	      			'nilai' => 0.75,
	      			'kriteria_nilai' => 'Diutamakan'
	      		],
	      		2 => [
	      			'sub_kriteria' => '>= 35100',
	      			'nilai' => 0.5,
	      			'kriteria_nilai' => 'Tidak Diutamakan'
	      		]
	      ]
	    ],
	    1 => [
	      'kriteria' => 'Mutu',
	      'bobot' => 0.234,
	      'keterangan' => 'benefit',
	      'child' => [
	      		0 => [
	      			'sub_kriteria' => 'Bagus',
	      			'nilai' => 1,
	      			'kriteria_nilai' => 'Sangat Diutamakan'
	      		],
	      		1 => [
	      			'sub_kriteria' => 'Sedang',
	      			'nilai' => 0.75,
	      			'kriteria_nilai' => 'Diutamakan'
	      		],
	      		2 => [
	      			'sub_kriteria' => 'Jelek',
	      			'nilai' => 0.5,
	      			'kriteria_nilai' => 'Tidak Diutamakan'
	      		]
	      ]
	    ],
	    2 => [
	      'kriteria' => 'Layanan',
	      'bobot' => 0.193,
	      'keterangan' => 'benefit',
	      'child' => [
	      		0 => [
	      			'sub_kriteria' => 'Sangat Memuaskan',
	      			'nilai' => 1,
	      			'kriteria_nilai' => 'Sangat Diutamakan'
	      		],
	      		1 => [
	      			'sub_kriteria' => 'Memuaskan',
	      			'nilai' => 0.75,
	      			'kriteria_nilai' => 'Diutamakan'
	      		],
	      		2 => [
	      			'sub_kriteria' => 'Tidak Memuaskan',
	      			'nilai' => 0.5,
	      			'kriteria_nilai' => 'Tidak Diutamakan'
	      		]
	      ]
	    ],
	    3 => [
	      'kriteria' => 'Pembayaran',
	      'bobot' => 0.159,
	      'keterangan' => 'benefit',
	      'child' => [
	      		0 => [
	      			'sub_kriteria' => 'Kredit',
	      			'nilai' => 1,
	      			'kriteria_nilai' => 'Sangat Diutamakan'
	      		],
	      		1 => [
	      			'sub_kriteria' => 'Tunai',
	      			'nilai' => 0.5,
	      			'kriteria_nilai' => 'Tidak Diutamakan'
	      		]
	      ]
	    ],
	   	4 => [
	      'kriteria' => 'Waktu',
	      'bobot' => 0.133,
	      'keterangan' => 'benefit',
	      'child' => [
	      		0 => [
	      			'sub_kriteria' => 'Tepat',
	      			'nilai' => 1,
	      			'kriteria_nilai' => 'Sangat Diutamakan'
	      		],
	      		1 => [
	      			'sub_kriteria' => 'Tidak Tepat',
	      			'nilai' => 0.5,
	      			'kriteria_nilai' => 'Tidak Diutamakan'
	      		]
	      ]
	    ]
	];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kriterias')->truncate();
        DB::table('sub_kriterias')->truncate();

	    foreach($this->kriteria as $key => $value){
		    DB::table('kriterias')->insert([
		      	'kriteria' => $value['kriteria'],
		        'bobot' => $value['bobot'],
		        'keterangan' => $value['keterangan'],
		        'created_at' => new DateTime(),
		        'updated_at' => new DateTime(),
		    ]);

		    $saveData = DB::table('kriterias')->where('kriteria', $value['kriteria'])->first();

		    foreach ($value['child'] as $key1 => $value1) {
		      	DB::table('sub_kriterias')->insert([
			      	'kriterias_id' => $saveData->id,
			        'sub_kriteria' => $value1['sub_kriteria'],
			        'nilai' => $value1['nilai'],
			        'kriteria_nilai' => $value1['kriteria_nilai'],
			        'created_at' => new DateTime(),
			        'updated_at' => new DateTime(),
			    ]);
		    }  
	    }
    }
}
