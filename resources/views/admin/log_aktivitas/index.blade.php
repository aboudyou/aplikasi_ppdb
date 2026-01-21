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
                        <nav aria-label="Page navigation" class="d-flex justify-content-center mt-4">
                            <ul class="pagination">
                                {{-- Previous Page Link --}}
                                @if ($logs->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">← Previous</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $logs->previousPageUrl() }}">← Previous</a>
                                    </li>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($logs->getUrlRange(1, $logs->lastPage()) as $page => $url)
                                    @if ($page == $logs->currentPage())
                                        <li class="page-item active">
                                            <span class="page-link">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($logs->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $logs->nextPageUrl() }}">Next →</a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link">Next →</span>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection