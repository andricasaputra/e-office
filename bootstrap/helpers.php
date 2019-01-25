<?php

if (! function_exists('excel')) {

	/**
	 * Mengambil instance dari PHP Excel yang ada di Service Container
	 *
	 * @return object Maatwebsite\Excel\Excel
	 */
	function excel() : Maatwebsite\Excel\Excel
	{
		return app('excel');
	}
}

if (! function_exists('pdf')) {

	/**
	 * Mengambil instance dari HTML2PDF yang ada di Service Container
	 *
	 * @return object Spipu\Html2Pdf\Html2Pdf
	 */
	function pdf() : Spipu\Html2Pdf\Html2Pdf
	{
		return app('PDF');
	}
}

if (! function_exists('admin')) {
	
	/**
	 * Authentifikasi jika user adalah admin
	 *
	 * @return boll|null
	 */
	function admin()
	{
		if(auth()->check()) {

			$cek = auth()->user()->role->first()->id;

			if ($cek  === 2 || $cek  === 3) return true;

			return;

		}
	
	}

}

if (! function_exists('bulan_tahun')) {
	
	/**
	 * Merubah date format (Y-m-d) menjadi ex : Januari 2000
	 * tanpa hari
	 *
	 * @param string $tanggal
	 * @return string
	 */
	function bulan_tahun(string $tanggal) : ?string
	{
	    $bulan = [

            1 => 'Januari',

            'Februari',

            'Maret',

            'April',

            'Mei',

            'Juni',

            'Juli',

            'Agustus',

            'September',

            'Oktober',

            'November',

            'Desember',

        ];

        $ex = explode('-', $tanggal);

        return $bulan[(int) $ex[1]] . ' ' . $ex[0];
	}

}

if (! function_exists('tanggal_indo')) {
	
	/**
	 * Merubah date format menjadi string
	 *
	 * @param string $tanggal
	 * @return string
	 */
	function tanggal_indo(string $tanggal) : ?string
	{
	    $bulan = [

	        1 => 'Januari',

	        'Februari',

	        'Maret',

	        'April',

	        'Mei',

	        'Juni',

	        'Juli',

	        'Agustus',

	        'September',

	        'Oktober',

	        'November',

	        'Desember',

	    ];

	    $ex = explode('-', $tanggal);

	    return $ex[2] . ' ' . $bulan[(int) $ex[1]] . ' ' . $ex[0];
	}
}

if (! function_exists('bulan')) {

	/**
	 * Merubah angka bulan menjadi string (Indonesia)
	 *
	 * @param string $bulan
	 * @return string
	 */
	function bulan($bulan) : ?string
	{
	    switch ($bulan) {

	        case 1:$bulan = "Januari";

	            break;

	        case 2:$bulan = "Februari";

	            break;

	        case 3:$bulan = "Maret";

	            break;

	        case 4:$bulan = "April";

	            break;

	        case 5:$bulan = "Mei";

	            break;

	        case 6:$bulan = "Juni";

	            break;

	        case 7:$bulan = "Juli";

	            break;

	        case 8:$bulan = "Agustus";

	            break;

	        case 9:$bulan = "September";

	            break;

	        case 10:$bulan = "Oktober";

	            break;

	        case 11:$bulan = "November";

	            break;

	        case 12:$bulan = "Desember";

	            break;

	    }

	    return $bulan;
	}

}

if (! function_exists('rp')) {

	/**
	 * Untuk menjadikan angka ke rupiah format
	 *
	 * @param string $rupiah
	 * @return string
	 */
	function rp($rupiah)
	{

		$rupiah = "Rp " . number_format($rupiah , 2 , "," , "."); 

   		return str_replace(",00", ",-", $rupiah);

	}
}





