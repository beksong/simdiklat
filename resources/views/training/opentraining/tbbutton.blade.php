@if(!$training->participants->isEmpty())
<a href="{{ url('training/showparticipants/'.$training->id) }}" class="badge bg-red"><i class="fa fa-tripadvisor"></i> Lihat Daftar Peserta</a>
&nbsp;&nbsp;<a href="{{ url('training/printparticipants/'.$training->id) }}" class="badge bg-blue"><i class="fa fa-print"></i> Cetak Absensi Peserta</a>
&nbsp;&nbsp;<a href="{{ url('training/exportparticipants/'.$training->id) }}" class="badge bg-green"><i class="fa fa-file-excel-o"></i> Export Daftar Peserta ke excel</a>
@endif