<x-app-layout>
    <div class="mb-6">
        <h2 class="font-bold text-2xl text-slate-800">Tambah Pengguna Baru</h2>
        <p class="text-slate-500">Buat akun untuk Kader atau Bidan.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 max-w-2xl">
        <form action="{{ route('admin.users.store') }}" method="POST" x-data="{ role: '' }">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" required class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Email (Untuk Login)</label>
                    <input type="email" name="email" required class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">No. HP (Untuk Notifikasi WA)</label>
                    <input type="text" name="no_hp" class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                <input type="password" name="password" required class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-slate-700 mb-1">Pilih Role</label>
                <!-- x-model="role" akan menyimpan nilai yang dipilih -->
                <select name="role" x-model="role" required class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    <option value="">-- Pilih Role --</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tampil jika Role adalah Bidan atau Orang Tua -->
            <div x-show="role === 'bidan' || role === 'orangtua'" class="mb-6" style="display: none;">
                <label class="block text-sm font-medium text-slate-700 mb-1">Pilih Desa</label>
                <select name="desa_id" class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    <option value="">-- Pilih Desa --</option>
                    @foreach($desas as $desa)
                        <option value="{{ $desa->id }}">{{ $desa->nama }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tampil jika Role adalah Kader -->
            <div x-show="role === 'kader'" class="mb-6" style="display: none;">
                <label class="block text-sm font-medium text-slate-700 mb-1">Pilih Posyandu</label>
                <select name="posyandu_id" class="w-full rounded-lg border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    <option value="">-- Pilih Posyandu --</option>
                    @foreach($posyandus as $posyandu)
                        <option value="{{ $posyandu->id }}">{{ $posyandu->nama }} ({{ $posyandu->desa->nama }})</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.users.index') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold py-2 px-4 rounded-lg transition-colors">Batal</a>
                <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-semibold py-2 px-4 rounded-lg shadow-sm transition-colors">Simpan Pengguna</button>
            </div>
        </form>
    </div>
</x-app-layout>