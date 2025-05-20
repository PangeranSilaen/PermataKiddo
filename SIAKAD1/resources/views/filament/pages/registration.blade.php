<x-filament-panels::page>
    <x-filament-panels::form wire:submit="submit">
        {{ $this->form }}
        <x-filament::button type="submit" class="mt-4">
            Kirim Pendaftaran
        </x-filament::button>
    </x-filament-panels::form>

    @if(auth()->user() && auth()->user()->hasRole('parent') && isset($bills))
        <div class="card mt-4">
            <div class="card-header bg-warning">
                <h5 class="mb-0">Tagihan SPP Anak</h5>
            </div>
            <div class="card-body">
                @forelse($bills as $namaAnak => $tagihan)
                    <h6>{{ $namaAnak }}</h6>
                    @if(count($tagihan))
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Bulan</th>
                                    <th>Nominal</th>
                                    <th>Status</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($tagihan as $bill)
                                <tr>
                                    <td>{{ ucfirst($bill->month) }}</td>
                                    <td>Rp{{ number_format($bill->amount,0,',','.') }}</td>
                                    <td>
                                        @if($bill->status == 'paid')
                                            <span class="badge bg-success">Lunas</span>
                                        @else
                                            <span class="badge bg-danger">Belum Lunas</span>
                                        @endif
                                    </td>
                                    <td>{{ $bill->payment_date ? date('d-m-Y', strtotime($bill->payment_date)) : '-' }}</td>
                                    <td>
                                        @if($bill->status != 'paid')
                                            <a href="{{ route('parent.pay', $bill->id) }}" class="btn btn-sm btn-primary">Bayar</a>
                                        @else
                                            <span class="text-success">Sudah dibayar</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Tidak ada tagihan SPP.</p>
                    @endif
                @empty
                    <p>Belum ada data anak terdaftar.</p>
                @endforelse
            </div>
        </div>
    @endif

    <div class="mt-8 text-center text-sm text-gray-500">
        <p>Setelah mengirimkan pendaftaran, admin akan mereview dan memproses data Anda.</p>
        <p>Harap tunggu konfirmasi dari kami melalui email atau telepon yang Anda daftarkan.</p>
    </div>
</x-filament-panels::page>
