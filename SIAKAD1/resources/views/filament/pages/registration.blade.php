<x-filament-panels::page>
    <x-filament-panels::form wire:submit="submit">
        {{ $this->form }}
        
        <x-filament::button type="submit" class="mt-4">
            Kirim Pendaftaran
        </x-filament::button>
    </x-filament-panels::form>
    
    <div class="mt-8 text-center text-sm text-gray-500">
        <p>Setelah mengirimkan pendaftaran, admin akan mereview dan memproses data Anda.</p>
        <p>Harap tunggu konfirmasi dari kami melalui email atau telepon yang Anda daftarkan.</p>
    </div>
</x-filament-panels::page>
