<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Kurban;
use Illuminate\Console\Command;

class DeleteExpiredKurban extends Command
{
    protected $signature = 'kurban:delete-expired';
    protected $description = 'Delete expired kurban data';

    public function handle()
    {
        $expirationPeriod = 1; // Jangka waktu dalam hari untuk menghapus data

        // Hitung tanggal batas waktu untuk penghapusan
        $expirationDate = Carbon::now()->subDays($expirationPeriod);

        // Query untuk mendapatkan data kurban yang melewati batas waktu
        $expiredKurban = Kurban::where('created_at', '<', $expirationDate)->get();

        // Hapus data kurban yang sudah melewati batas waktu
        foreach ($expiredKurban as $kurban) {
            $kurban->delete();
        }

        $this->info('Expired kurban data have been deleted successfully.');
    }
}
