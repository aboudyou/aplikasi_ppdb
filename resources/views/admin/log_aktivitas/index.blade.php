@extends('layouts.app')

@section('title', 'Log Aktivitas')

@section('content')
<div class="container-fluid px-3 mt-4">
    <h3 class="mb-4"><i class="bi bi-activity"></i> Log Aktivitas</h3>
    <div class="row g-4">
        <div class="col-12">
            <div class="card" data-aos="fade-up">
                <div class="card-header">
                    <h5 class="card-title mb-0">Riwayat Aktivitas Pengguna</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th><i class="bi bi-person"></i> User</th>
                                    <th><i class="bi bi-lightning"></i> Aktivitas</th>
                                    <th><i class="bi bi-chat-dots"></i> Deskripsi</th>
                                    <th><i class="bi bi-globe"></i> IP Address</th>
                                    <th><i class="bi bi-clock"></i> Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($logs as $log)
                                    <tr>
                                        <td>{{ $loop->iteration + ($logs->currentPage() - 1) * $logs->perPage() }}</td>
                                        <td>
                                            <strong>{{ $log->user->name ?? 'N/A' }}</strong>
                                            <br><small class="text-muted">{{ $log->user->email ?? '' }}</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary">{{ $log->aktivitas }}</span>
                                        </td>
                                        <td>{{ $log->deskripsi ?: '-' }}</td>
                                        <td><code>{{ $log->ip_address ?: '-' }}</code></td>
                                        <td>{{ $log->created_at->format('d M Y H:i:s') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <i class="bi bi-info-circle text-muted" style="font-size: 2rem;"></i>
                                            <p class="text-muted mt-2">Belum ada log aktivitas.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($logs->hasPages())
                        <div class="d-flex justify-content-center mt-3">
                            {{ $logs->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection