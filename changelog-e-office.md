## e-office-v1 | writed on : 20/02/2019

# SYSTEM UPDATE

* Perbaikan views table migration (add where condition)
* Perbaikan data frekuensi chart pada home/ dashboard

# FOR ADMIN PAGE

* Add database management (backup & restore)
* File backup tersimpan di dalam storage folder, tipe file adalah sql & zip
* File restore harus berupa .sql untuk saat ini

# INFO UPDATE APLIKASI (TO USER)

* Perbaikan kolom volume pada download excel rekapitulasi komoditi

----------------------------------------------------------------------------------------------------------

## e-office-v1 | writed on : 22/01/2019

# TODO

* upadate pembatalan_dok_kh column bulan dari int -> date
* upadate pembatalan_dok_kt column bulan dari int -> date

# SYSTEM UPDATE

* Refactory code to laravel style (no more if else on model)
* Add views table, khusus untuk fungsi agregasi untuk digunakan sebagai perhitungan data & statistik
* Add ajax untuk load ringkasan data pada landing page

# FOR ADMIN PAGE

* Add master dokumen
* Add pengumuman

# INFO UPDATE APLIKASI (TO USER)

* Add upload (serah terima, reekspor, pembatalan dokumen)
* Add opsi pencarian pada tabel log pengiriman laporan
  + opsi (tahun, bulan, type permohonan)
* Add download laporan (rekapitulasi, operasional, permakaian dokumen)
* Add penerimaan, pemakaian, pembatalan dokumen beserta info dan detailnya
* Add kolom volume, negara asal & tujuan pada tabel rekapitulasi komoditi

----------------------------------------------------------------------------------------------------------