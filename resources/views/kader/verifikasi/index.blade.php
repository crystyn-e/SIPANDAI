<x-app-layout>
    <div class="space-y-6">
        {{-- 1. EXECUTIVE HEADER BANNER --}}
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-primary-950 to-primary-900 p-6 sm:p-8 text-white shadow-lg border border-primary-800/50">
            <div class="pointer-events-none absolute -right-12 -top-12 h-56 w-56 rounded-full bg-emerald-400/15 blur-2xl"></div>
            <div class="pointer-events-none absolute right-28 -bottom-16 h-48 w-48 rounded-full bg-amber-400/15 blur-2xl"></div>

            <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/15 backdrop-blur-xs text-xs font-semibold text-emerald-300 mb-3">
                        <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        {{ Auth::user()->posyandu->nama ?? 'Unit Layanan Posyandu' }}
                        @if(Auth::user()->posyandu?->desa)
                            • Desa {{ Auth::user()->posyandu->desa->nama }}
                        @endif
                    </div>
                    <h2 class="font-extrabold text-2xl sm:text-3xl tracking-tight text-white">
                        Verifikasi Akun Orang Tua
                    </h2>
                    <p class="text-sm sm:text-base text-slate-300 mt-1.5 max-w-2xl">
                        Tinjau dan aktifkan pendaftaran akun mandiri warga agar orang tua dapat mengakses Buku KIA Digital.
                    </p>
                </div>

                {{-- Mini Counter Antrean --}}
                <div class="px-5 py-3.5 rounded-2xl bg-white/10 border border-white/15 backdrop-blur-xs shrink-0">
                    <p class="text-[11px] uppercase tracking-wider font-semibold text-slate-300">Menunggu Persetujuan</p>
                    <p class="text-2xl font-extrabold {{ $pendingUsers->count() > 0 ? 'text-amber-300' : 'text-emerald-300' }} tabular-nums mt-0.5">
                        {{ $pendingUsers->count() }} <span class="text-xs font-normal text-slate-300">Pendaftar</span>
                    </p>
                </div>
            </div>
        </div>

        {{-- 2. ALERT NOTIFIKASI SUKSES --}}
        @if(session('success'))
            <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200/90 text-emerald-900 px-5 py-4 rounded-2xl shadow-2xs">
                <div class="w-9 h-9 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-emerald-700">Verifikasi Berhasil</p>
                    <p class="text-sm font-medium text-slate-800">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        {{-- 3. TABEL ANTREAN VERIFIKASI --}}
        <div class="bg-white rounded-3xl shadow-xs border border-slate-200/90 overflow-hidden">
            {{-- Toolbar & Pencarian Instan --}}
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/70 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-2.5">
                    <h3 class="font-bold text-slate-900">Daftar Pendaftar Mandiri</h3>
                    @if($pendingUsers->count() > 0)
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-extrabold bg-amber-100 text-amber-900 border border-amber-200/80 tabular-nums">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-600 animate-pulse"></span>
                            {{ $pendingUsers->count() }} Pending
                        </span>
                    @endif
                </div>

                <div class="relative w-full sm:w-72">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <input type="text"
                           id="pendingUserSearchInput"
                           placeholder="Cari nama, email, atau no HP..."
                           class="w-full pl-10 pr-4 py-2 text-sm bg-white border border-slate-200 rounded-xl text-slate-800 placeholder-slate-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/90 border-b border-slate-200/80 text-slate-500 text-[11px] font-bold uppercase tracking-wider">
                        <tr>
                            <th class="py-3.5 px-6">Identitas Pendaftar</th>
                            <th class="py-3.5 px-6">Kontak & Email</th>
                            <th class="py-3.5 px-6">Status</th>
                            <th class="py-3.5 px-6 text-right">Aksi Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($pendingUsers as $user)
                            <tr class="pending-user-row group hover:bg-amber-50/25 transition-colors">
                                {{-- Nama & Avatar --}}
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3.5">
                                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-100 to-orange-100 text-amber-800 font-bold text-xs flex items-center justify-center shrink-0 border border-amber-200/70">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-900 group-hover:text-primary-700 transition-colors">
                                                {{ $user->name }}
                                            </p>
                                            <p class="text-xs text-slate-400 mt-0.5">
                                                Mendaftar {{ $user->created_at?->diffForHumans() ?? 'baru saja' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                {{-- Email & No HP --}}
                                <td class="py-4 px-6">
                                    <p class="font-medium text-slate-800">{{ $user->email }}</p>
                                    <p class="text-xs text-slate-500 tabular-nums mt-0.5">
                                        WA / HP: <span class="font-semibold text-slate-700">{{ $user->no_hp ?? '-' }}</span>
                                    </p>
                                </td>

                                {{-- Badge Status --}}
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-800 border border-amber-200/90 px-3 py-1 rounded-full text-xs font-bold uppercase">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                        Pending
                                    </span>
                                </td>

                                {{-- Tombol Verifikasi --}}
                                <td class="py-4 px-6 text-right">
                                    <form action="{{ route('kader.verifikasi.verify', $user->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="inline-flex items-center justify-center gap-1.5 bg-gradient-to-r from-primary-700 via-primary-600 to-emerald-600 hover:from-primary-800 hover:to-emerald-700 text-white text-xs sm:text-sm font-bold py-2 px-4 rounded-xl shadow-xs transition-all hover:-translate-y-0.5">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                            </svg>
                                            Verifikasi Sekarang
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-14 px-6 text-center">
                                    <div class="mx-auto w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-200/80 flex items-center justify-center mb-3">
                                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </div>
                                    <p class="font-extrabold text-slate-900 text-base">Semua Pendaftaran Telah Diverifikasi</p>
                                    <p class="text-xs sm:text-sm text-slate-500 mt-1">Tidak ada akun warga yang menunggu persetujuan saat ini.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- SCRIPT PENCARIAN INSTAN --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('pendingUserSearchInput');
            if (searchInput) {
                searchInput.addEventListener('input', function () {
                    const keyword = this.value.toLowerCase().trim();
                    document.querySelectorAll('.pending-user-row').forEach(row => {
                        row.style.display = row.textContent.toLowerCase().includes(keyword) ? '' : 'none';
                    });
                });
            }
        });
    </script>
</x-app-layout>