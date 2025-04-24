<?php

namespace Database\Seeders;

use App\Models\Resident;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ResidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 10; $i++) {
            $tanggalLahir = $faker->dateTimeBetween('-50 years', '-18 years');
            $formattedTanggal = Carbon::parse($tanggalLahir)->format('dmy');
            $prefix = '327703' . $formattedTanggal;

            $lastResident = Resident::where('nik', 'like', "$prefix%")
                ->orderBy('nik', 'desc')
                ->first();

            if ($lastResident) {
                $lastSequence = (int) substr($lastResident->nik, -4);
                $newSequence = str_pad($lastSequence + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $newSequence = '0001';
            }

            $nik = $prefix . $newSequence;

            Resident::create([
                'id' => Str::uuid(),
                'nik' => $nik,
                'nama' => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['pria', 'wanita']),
                'tanggal_lahir' => $tanggalLahir->format('Y-m-d'),
                'tempat_lahir' => $faker->city,
                'alamat' => $faker->address,
                'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha']),
                'status_menikah' => $faker->randomElement(['belum_menikah', 'menikah', 'cerai']),
                'pekerjaan' => $faker->jobTitle,
                'telepon' => $faker->phoneNumber,
                'status' => $faker->randomElement(['aktif', 'pindah', 'meninggal']),
            ]);
        }
    }
}
