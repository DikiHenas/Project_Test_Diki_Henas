<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class PegawaiExport implements FromView,WithCustomCsvSettings,WithColumnFormatting
{

	public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
	public function columnFormats(): array
    {
        return [            
            'E' => "##-####-####",
        ];
    }

    private $_results;

	/**
	 * Create a new exporter instance.
	 *
	 * @param array $results query result
	 *
	 * @return void
	 */
	public function __construct($results)
	{
		$this->_results = $results;
	}

	/**
	 * Load the view.
	 *
	 * @return void
	 */
	public function view(): View
	{
		return view(
			'admin.pegawai.exports.pegawai_csv',
			[
				'pegawai' => $this->_results,
			]
		);
	}
}
