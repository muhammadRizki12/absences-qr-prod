@extends('layouts.guru')

@section('title', 'Jadwal Guru')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Jadwal Guru</h4>
                    </div>
                    <div class="card-body">
                        <!-- Table for Jadwal Mengajar -->
                        <table class="table text-center table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Kelas</th>
                                    <th>Hari</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedules as $schedule)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $schedule->study }}</td>
                                        <td>{{ $schedule->class->class_name }}</td>
                                        <td>{{ $schedule->day }}</td>
                                        <td>{{ substr($schedule->entry_time, 0, 5) }} -
                                            {{ substr($schedule->out_time, 0, 5) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
