<script>

  $(document).ready(function(){

    /*add loader*/
    loader();

    let year      = $('#year').val();

    let month     = $('#month').val();

    let wilker    = $('#wilker').val();

    let tableUrl  = '{{ route('api.operasional.dashboard') }}';

    /*chart properties*/

    let khValue     = 'Domestik Keluar Karantina Hewan';

    let ktValue     = 'Domestik Keluar Karantina Tumbuhan';

    let khUrl       = '{{ route('api.kh.detail.frekuensi.chart') }}';

    let ktUrl       = '{{ route('api.kt.detail.frekuensi.chart') }}';

    let chartKhUrl  = khUrl + '/' + khValue + '/' + year;

    let chartKtUrl  = ktUrl + '/' + ktValue + '/' + year;

    /*set judul halaman*/

    $('#judul').html(`Ringkasan Data Operasional Tahun : ${year}`);

    /*init table, charts, and display top 5 komoditi*/

    tableInfo();

    chartKh(chartKhUrl, khValue);

    chartKt(chartKtUrl, ktValue);

    $('#change_data').on('submit', function(e){

      e.preventDefault();

      /*add loader*/
      loader();

      year        = $('#year').val();

      month       = $('#month').val();

      wilker      = $('#wilker').val();

      tableUrl    = '{{ route('api.operasional.dashboard') }}/' + year + '/' + month + '/' + wilker;

      chartKhUrl  = khUrl + '/' + khValue + '/' + year;

      chartKtUrl  = ktUrl + '/' + ktValue + '/' + year;

      /*update judul halaman*/

      let monthText   = $('#month option:selected').text();

      let wilkerText  = $('#wilker option:selected').text();
    
      $('#judul').html(`Ringkasan Data Operasional Tahun : ${year}, Bulan : ${monthText}, Wilker : ${wilkerText}`);

      /*update table, charts, and display top 5 komoditi*/

      tableInfo();

      chartKh(chartKhUrl, khValue);

      chartKt(chartKtUrl, ktValue);

    });

    /*Table & top 5*/

    function tableInfo()
    {
      return  $.ajax({

        url : tableUrl

      }).done(function(response){

        /*table ringkasan data*/

        let volumeKh  = [];

        let volumeKt  = [];

        let dokumenKh = [];

        let dokumenKt = [];

        $.each(response.kh.volume, function(key, value){

          volumeKh += `<p>${value}</p>`;
           
        });

        $.each(response.kt.volume, function(key, value){

          volumeKt += `<p>${value}</p>`;
           
        });

        $.each(response.kh.dokumen, function(key, value){

          dokumenKh += `<p>${value.dokumen} : ${value.total}</p>`;
           
        });

        $.each(response.kt.dokumen, function(key, value){

          dokumenKt += `<p>${value.dokumen} : ${value.total}</p>`;
           
        });

        $('#table-dashboard tbody').html(`

          <tr>
            <td>
              <i class="fa fa-line-chart"></i>&nbsp;&nbsp;<span style="font-weight: bold;">Frekuensi</span>
            </td>
            <td>
              ${response.kh.frekuensi} Kali
            </td>
            <td>
              ${response.kt.frekuensi} Kali
            </td>
            <td>
                <label class="label label-primary">Berdasarkan Komoditas</label>
            </td>
          </tr>

          <tr>
            <td>
              <i class="fa fa-bar-chart"></i>&nbsp;&nbsp;<span style="font-weight: bold;">Volume</span>
            </td>
            <td>
              ${volumeKh}
            </td>
            <td>
              ${volumeKt}
            </td>
            <td>
              <label class="label label-success">Berdasarkan Satuan</label>
            </td>
          </tr>

          <tr>
            <td>
              <i class="fa fa-money"></i>&nbsp;&nbsp;<span style="font-weight: bold;">PNBP</span>
            </td>
            <td>
              ${response.kh.pnbp}
            </td>
            <td>
              ${response.kt.pnbp}
            </td>
            <td>
              <label class="label label-danger">Berdasarkan Sertifikasi</label>
            </td>
          </tr>

          <tr>
            <td>
              <i class="fa fa-book"></i> &nbsp;&nbsp;<span style="font-weight: bold;">Pemakaian Dokumen</span>
            </td>
            <td>
              ${dokumenKh}
            </td>
            <td>
              ${dokumenKt}
            </td>
            <td>
              <label class="label label-info">Berdasarkan Sertifikasi</label>
            </td>
          </tr>

        `);


        /*top Five Komoditi Kh*/
        $('#topFiveKh').empty();

        $.each(response.kh.topFive, function(key, value){

          $('#topFiveKh').append(

            `<li class="feed-item">
              ${key}
              <span class="ml-auto font-14 text-muted" style="color: #000 !important; font-weight: bold;">${value}</span>
            </li>`

            );

        });

        /*top Five Komoditi Kt*/
        $('#topFiveKt').empty();

        $.each(response.kt.topFive, function(key, value){

          $('#topFiveKt').append(

            `<li class="feed-item">
              ${key}
              <span class="ml-auto font-14 text-muted" style="color: #000 !important; font-weight: bold;">${value}</span>
            </li>`

            );
           
        });

      });/*end table ajax*/
    }

    /*Charts*/

    function chartKh(url, type)
    {
        $.ajax({

          url : url

        }).done(function(response){

          let dataKh = {

            data : [],
            name : []

          };

          $.each(response, function(key, value){

            dataKh.name.push(value.bln); 
            dataKh.data.push(parseInt(value.data));  

          });

          /*Hightchart colors option*/
          Highcharts.setOptions({
            colors: ['#7460EE']
          });

          /*Chart KH*/
          let chartKh = Highcharts.chart('chartFrekuensiKh', {
            credits : false,
            chart: {
                type: 'column'
            },
            title: {
                text: 'Frekuensi Operasional Karantina Hewan'
            },
            subtitle: {
                text: type
            },
            xAxis: {
                categories:  dataKh.name,
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Frekuensi (kali)'
                }
            },
            tooltip: {
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name:'Frekuensi' ,
                data: dataKh.data
            }]
        });

      });/*End Ajax KH*/
    }

    function chartKt(url, type)
    {
        $.ajax({

          url : url

        }).done(function(response){

          let dataKt = {

            data : [],
            name : []

          };

          $.each(response, function(key, value){

            dataKt.name.push(value.bln); 
            dataKt.data.push(parseInt(value.data)); 

          });

          /*Hightchart colors option*/
          Highcharts.setOptions({
            colors: ['#12AFAF', '#F62D51', '#64E572', '#2962FF']
          });

          /*Chart KH*/
          let chartKt = Highcharts.chart('chartFrekuensiKt', {
            credits : false,
            chart: {
                type: 'column'
            },
            title: {
                text: 'Frekuensi Operasional Karantina Tumbuhan'
            },
            subtitle: {
                text: type
            },
            xAxis: {
                categories:  dataKt.name,
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Frekuensi (kali)'
                }
            },
            tooltip: {
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name:'Frekuensi' ,
                data: dataKt.data
            }]
        });

      });/*End Ajax KT*/
    }

    $('#selectCatKh').change(function(){

        khValue     = $('#selectCatKh').val();

        chartKhUrl  = khUrl + '/' + khValue + '/' + year;

        chartKh(chartKhUrl, khValue);

    });/*End Select KH*/

    $('#selectCatKt').change(function(){

      ktValue = $('#selectCatKt').val();

      chartKtUrl  = ktUrl + '/' + ktValue + '/' + year;

      chartKt(chartKtUrl, ktValue);

    });/*End Select KT*/

    function loader()
    {
      /*table data loader*/
      $('#table-dashboard tbody').html(`<td colspan="4" style="text-align: center;"><img src='{{ asset('images/ajax-loader.gif') }}'></td>`);
      /*top 5 komoditi loader*/
      $('#topFiveKh').html(`<div class='text-center'><img src='{{ asset('images/ajax-loader.gif') }}'></div>`);
      $('#topFiveKt').html(`<div class='text-center'><img src='{{ asset('images/ajax-loader.gif') }}'></div>`);
      /*charts loader*/
      $('#chartFrekuensiKh').html(`<div class='text-center'><img src='{{ asset('images/ajax-loader.gif') }}'></div>`);
      $('#chartFrekuensiKt').html(`<div class='text-center'><img src='{{ asset('images/ajax-loader.gif') }}'></div>`);
    }

  });/*End Ready*/

</script>