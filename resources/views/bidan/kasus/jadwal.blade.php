<x-app-layout>
    <div class="mb-6">
        <h2 class="font-bold text-2xl text-slate-800">Jadwal Kegiatan Posyandu</h2>
        <p class="text-slate-500">Daftar jadwal penimbangan dan kegiatan di desa Anda.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($jadwals as $jadwal)
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 border-t-4 border-t-primary-500">
                <div class="flex justify-between items-start mb-4">
                    <div class="bg-primary-50 text-primary-700 px-3 py-1 rounded-lg text-sm font-bold">
                        {{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}
                    </div>
                </div>
                <h3 class="font-bold text-lg text-slate-800 mb-2">{{ $jadwal->kegiatan }}</h3>
                <p class="text-slate-500 text-sm mb-4">{{ $jadwal->posyandu->nama }} ({{ $jadwal->posyandu->desa->nama }})</p>
                
                @if($jadwal->keterangan)
                    <p class="text-slate-600 text-sm border-t border-slate-100 pt-3">{{ $jadwal->keterangan }}</p>
                @endif
            </div>
        @empty
            <div class="col-span-3 bg-white p-8 rounded-2xl shadow-sm border border-slate-200 text-center">
                <p class="text-slate-500">Belum ada jadwal kegiatan untuk desa Anda.</p>
            </div>
        @endforelse
    </div>
</x-app-layout>