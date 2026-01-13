@extends('layouts.guru')

@section('title', 'Data Kehadiran Guru')

@section('content')

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Data Kehadiran Guru</h4>
                    </div>
                    <div class="card-body">
                        <!-- Tabel Kehadiran -->
                        <table class="table text-center table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Kelas</th>
                                    <th>Waktu</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absences as $index => $absence)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $absence->schedule->day }}, {{ $absence->date }}</td>
                                        <td>{{ $absence->schedule->study }}</td>
                                        <td>{{ $absence->schedule->class->class_name }}</td>
                                        <td>{{ substr($absence->time, 0, 5) }}</td>
                                        <td>{{ $absence->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Button Refresh -->
                </div>
            </div>
        </div>
    </div>

@endsection
