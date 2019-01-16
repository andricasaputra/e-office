<!DOCTYPE html>
<html>
<head></head>
<body>

	{{-- judul laporan --}}
	REKAPITULASI DATA <br>
	
	LAPORAN KEGIATAN OPERASIONAL KARANTINA TUMBUHAN <br>
	
	{{ strtoupper($datas['permohonan']) }} <br>
	
	{{ strtoupper($datas['wilker']) }} <br>
	
	{{ empty($datas['bulan']) ? '' : 'BULAN : '. strtoupper($datas['bulan']) }} TAHUN : {{ $datas['tahun'] }} <br>
	
	<br>
	
	<table>
		{{-- table header --}}
		<tr>
			
			@foreach($datas['headers'] as $header)
			
			<td valign="middle" style="text-align: center;font-weight: bold;border: 1px solid #000;font-size: 12">{{ $header }}</td>
			
			@endforeach
			
		</tr>
		
		{{-- table body --}}
		@if(count($datas['bodies']) > 0)
		
		@php $no = 1 @endphp
		
		@foreach($datas['bodies'] as $subdatas)
		
		@foreach($subdatas as $komoditi => $data)
		
		@if(count($subdatas) === 1 && $komoditi == '')
		
		<tr>
			
			<td valign="middle" style="text-align: center;border: 1px solid #000">
				{{ $no++ }}
			</td>
			
			<td valign="middle" style="text-align: center;border: 1px solid #000">
				{{ $data['wilker'] }}
			</td>
			
			<td valign="middle" style="text-align: center;border: 1px solid #000">
				Nihil
			</td>
			
			<td valign="middle" style="text-align: center;border: 1px solid #000">
				Nihil
			</td>
			
			<td valign="middle" style="text-align: center;border: 1px solid #000">
				Nihil
			</td>
			
			<td valign="middle" style="text-align: center;border: 1px solid #000">
				Nihil
			</td>
			
			<td valign="middle" style="text-align: center;border: 1px solid #000;width:30;font-size: 9">
				
				Nihil
				
			</td>
			
			<td valign="middle" style="text-align: center;border: 1px solid #000;width:30;font-size: 9">
				
				Nihil
				
			</td>
			
		</tr>
		
		@else
		
		@if($komoditi != '' && $data['volume'] !== 0)
		
		<tr>
			
			<td valign="middle" style="text-align: center;border: 1px solid #000">
				{{ $no++ }}
			</td>
			
			<td valign="middle" style="text-align: center;border: 1px solid #000">
				{{ $data['wilker'] }}
			</td>
			
			<td valign="middle" style="text-align: center;border: 1px solid #000">
				{{ $komoditi ?? '-' }}
			</td>
			
			<td valign="middle" style="text-align: center;border: 1px solid #000">
				{{ number_format($data['volume'], 0, ',', '.') ?? '-' }}
			</td>
			
			<td valign="middle" style="text-align: center;border: 1px solid #000">
				{{ $data['satuan'] ?? '-' }}
			</td>
			
			<td valign="middle" style="text-align: center;border: 1px solid #000">
				{{ number_format($data['frekuensi'], 0, ',', '.') ?? '-' }}
			</td>
			
			<td valign="middle" style="text-align: center;border: 1px solid #000;width:30;font-size: 9">

				@if($datas['permohonan'] == 'Ekspor' || $datas['permohonan'] == 'Impor' || $datas['permohonan'] == 'Reekspor')
				
				@foreach($data['negara_asal'] as $negara_asal => $value)
				
				@if(! $loop->last)
				{{ $negara_asal ?? '-' }},
				@else
				{{ $negara_asal ?? '-' }}
				@endif
				
				@endforeach

				@else

				@foreach($data['kota_asal'] as $kota_asal => $value)
				
				@if(! $loop->last)
				{{ $kota_asal ?? '-' }},
				@else
				{{ $kota_asal ?? '-' }}
				@endif
				
				@endforeach

				@endif
				
			</td>
			
			<td valign="middle" style="text-align: center;border: 1px solid #000;width:30;font-size: 9">

				@if($datas['permohonan'] == 'Ekspor' || $datas['permohonan'] == 'Impor' || $datas['permohonan'] == 'Reekspor')
				
				@foreach($data['negara_tuju'] as $negara_tuju => $value)
				
				@if(! $loop->last)
				{{ $negara_tuju ?? '-' }},
				@else
				{{ $negara_tuju ?? '-' }}
				@endif
				
				@endforeach

				@else

				@foreach($data['kota_tuju'] as $kota_tuju => $value)
				
				@if(! $loop->last)
				{{ $kota_tuju ?? '-' }},
				@else
				{{ $kota_tuju ?? '-' }}
				@endif
				
				@endforeach

				@endif
				
			</td>
			
		</tr>
		
		@endif
		
		@endif
		
		@endforeach
		
		@endforeach
		
		@else
		
		<tr>
			
			<td valign="middle" style="text-align: center;border: 1px solid #000">
				1
			</td>
			
			<td valign="middle" style="text-align: center;border: 1px solid #000">
				Nihil
			</td>
			
			<td valign="middle" style="text-align: center;border: 1px solid #000">
				Nihil
			</td>
			
			<td valign="middle" style="text-align: center;border: 1px solid #000">
				Nihil
			</td>
			
			<td valign="middle" style="text-align: center;border: 1px solid #000">
				Nihil
			</td>
			
			<td valign="middle" style="text-align: center;border: 1px solid #000">
				Nihil
			</td>
			
			<td valign="middle" style="text-align: center;border: 1px solid #000;width:30;font-size: 9">
				
				Nihil
				
			</td>
			
			<td valign="middle" style="text-align: center;border: 1px solid #000;width:30;font-size: 9">
				
				Nihil
				
			</td>
			
		</tr>
		
		@endif
		
		<tr>
			<td></td>
		</tr>
		
		<tr>
			@for($i=1; $i < 5; $i++)
			<td></td>
			@endfor
			<td colspan="4" valign="bottom" style="font-weight: bold;text-align: center;font-size: 16">
				Sumbawa Besar, {{ date('d/m/Y') }}
			</td>
		</tr>
		
		<tr>
			@for($i=1; $i < 5; $i++)
			<td></td>
			@endfor
			<td colspan="4" valign="top" style="font-weight: bold;text-align: center;font-size: 16">
				{{ $datas['signatory']->jabatan->jabatan }}
			</td>
		</tr>
		
		<tr>
			<td style="height: 100"></td>
		</tr>
		
		<tr>
			@for($i=1; $i < 5; $i++)
			<td></td>
			@endfor
			<td colspan="4" valign="bottom" style="font-weight: bold;text-align: center;font-size: 16">
				{{ $datas['signatory']->nama }}
			</td>
		</tr>
		
		<tr>
			@for($i=1; $i < 5; $i++)
			<td></td>
			@endfor
			<td colspan="4" valign="top" style="font-weight: bold;text-align: center;font-size: 16">
				{{ $datas['signatory']->nip }}
			</td>
		</tr>
		
	</table>
	
	
</body>
</html>