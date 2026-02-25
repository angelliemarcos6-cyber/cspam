
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\School;
use Illuminate\Support\Facades\Hash;

class SchoolAndUserSeeder extends Seeder
{
    public function run(): void
    {
        // ────────────────────────────────────────────────
        //          DIVISION ADMIN
        // ────────────────────────────────────────────────
        $admin = User::create([
            'name'     => 'Division Admin',
            'email'    => 'admin@sdo-santiago.ph',
            'password' => Hash::make('Admin123!'),
            'school_id' => null,
        ]);
        $admin->assignRole('Division Admin');

        // ────────────────────────────────────────────────
        //          MONITORS
        // ────────────────────────────────────────────────
        $monitors = [
            ['name' => 'Arcadio L. Modumo, JR', 'email' => 'monitor1@sdo-santiago.ph', 'password' => 'Monitor123!'],
            ['name' => 'Shirlyn R. Macaspac',   'email' => 'monitor2@sdo-santiago.ph', 'password' => 'Monitor123!'],
        ];
        foreach ($monitors as $data) {
            $user = User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => Hash::make($data['password']),
                'school_id' => null,
            ]);
            $user->assignRole('SMM&E Monitor');
        }

        // ────────────────────────────────────────────────
        //
        //
        // ────────────────────────────────────────────────
        $schools = [
            // Elementary (Public) - 30 schools
            ['name' => 'Santiago East Central School', 'type' => 'Elementary (Public)', 'is_public' => true],
            ['name' => 'Santiago North Central School', 'type' => 'Elementary (Public)', 'is_public' => true],
            ['name' => 'Santiago South Central School', 'type' => 'Elementary (Public)', 'is_public' => true],
            ['name' => 'Santiago West Central School', 'type' => 'Elementary (Public)', 'is_public' => true],
            ['name' => 'Abra Elementary School', 'type' => 'Elementary (Public)', 'is_public' => true],
            ['name' => 'Ambalatungan Elementary School', 'type' => 'Elementary (Public)', 'is_public' => true],
            ['name' => 'Ballintocatoc Elementary School', 'type' => 'Elementary (Public)', 'is_public' => true],
            ['name' => 'Baluarte Elementary School', 'type' => 'Elementary (Public)', 'is_public' => true],
            ['name' => 'Bannauag Norte Elementary School', 'type' => 'Elementary (Public)', 'is_public' => true],
            ['name' => 'Batal Elementary School', 'type' => 'Elementary (Public)', 'is_public' => true],
            ['name' => 'Buenavista Elementary School', 'type' => 'Elementary (Public)', 'is_public' => true],
            ['name' => 'Calaocan Elementary School', 'type' => 'Elementary (Public)', 'is_public' => true],
            ['name' => 'C. Bautista Elementary School', 'type' => 'Elementary (Public)', 'is_public' => true],
            ['name' => 'Divisoria Elementary School', 'type' => 'Elementary (Public)', 'is_public' => true],
            ['name' => 'Dubinan Elementary School', 'type' => 'Elementary (Public)', 'is_public' => true],
            ['name' => 'Luna Elementary School', 'type' => 'Elementary (Public)', 'is_public' => true],
            ['name' => 'Mabini Elementary School', 'type' => 'Elementary (Public)', 'is_public' => true],
            ['name' => 'Malini Elementary School', 'type' => 'Elementary (Public)', 'is_public' => true],
            ['name' => 'Naggassican Elementary School', 'type' => 'Elementary (Public)', 'is_public' => true],
            ['name' => 'Nabuan Elementary School', 'type' => 'Elementary (Public)', 'is_public' => true],
            ['name' => 'Patul Elementary School', 'type' => 'Elementary (Public)', 'is_public' => true],
            ['name' => 'Rosario Elementary School', 'type' => 'Elementary (Public)', 'is_public' => true],
            ['name' => 'Sagana Elementary School', 'type' => 'Elementary (Public)', 'is_public' => true],
            ['name' => 'Salvador Elementary School', 'type' => 'Elementary (Public)', 'is_public' => true],
            ['name' => 'San Andres Elementary School', 'type' => 'Elementary (Public)', 'is_public' => true],
            ['name' => 'San Jose Elementary School', 'type' => 'Elementary (Public)', 'is_public' => true],
            ['name' => 'Santa Rosa Elementary School', 'type' => 'Elementary (Public)', 'is_public' => true],
            ['name' => 'Sinili Elementary School', 'type' => 'Elementary (Public)', 'is_public' => true],
            ['name' => 'Sinsayon Elementary School', 'type' => 'Elementary (Public)', 'is_public' => true],
            ['name' => 'Victory Norte Elementary School', 'type' => 'Elementary (Public)', 'is_public' => true],
            ['name' => 'Villa Gonzaga Elementary School', 'type' => 'Elementary (Public)', 'is_public' => true],

            // Elementary (Private) - 8 schools
            ['name' => 'University of La Salette (ULS) Grade School Department', 'type' => 'Elementary (Private)', 'is_public' => false],
            ['name' => 'Top Achievers Private School - Santiago Campus', 'type' => 'Elementary (Private)', 'is_public' => false],
            ['name' => 'Children First School (CFS)', 'type' => 'Elementary (Private)', 'is_public' => false],
            ['name' => 'Santiago Cultural Institute', 'type' => 'Elementary (Private)', 'is_public' => false],
            ['name' => 'Infant Jesus Montessori School', 'type' => 'Elementary (Private)', 'is_public' => false],
            ['name' => 'Kiddie Toes Montessori School', 'type' => 'Elementary (Private)', 'is_public' => false],
            ['name' => 'Galilee Integrated School', 'type' => 'Elementary (Private)', 'is_public' => false],
            ['name' => 'Sefton Village Christian School', 'type' => 'Elementary (Private)', 'is_public' => false],

            // Public High School - 7 schools
            ['name' => 'Santiago City National High School', 'type' => 'High School (Public)', 'is_public' => true],
            ['name' => 'Cabulay High School', 'type' => 'High School (Public)', 'is_public' => true],
            ['name' => 'Naggasican National High School', 'type' => 'High School (Public)', 'is_public' => true],
            ['name' => 'Rizal National High School', 'type' => 'High School (Public)', 'is_public' => true],
            ['name' => 'Rosario National High School', 'type' => 'High School (Public)', 'is_public' => true],
            ['name' => 'Sagana National High School', 'type' => 'High School (Public)', 'is_public' => true],
            ['name' => 'Sinsayon National High School', 'type' => 'High School (Public)', 'is_public' => true],

            // Integrated (Public) - 7 schools
            ['name' => 'Balintocatoc Integrated School', 'type' => 'Integrated (Public)', 'is_public' => true],
            ['name' => 'Bannaway Norte Integrated School', 'type' => 'Integrated (Public)', 'is_public' => true],
            ['name' => 'Nabuan Integrated School', 'type' => 'Integrated (Public)', 'is_public' => true],
            ['name' => 'Salvador Integrated School', 'type' => 'Integrated (Public)', 'is_public' => true],
            ['name' => 'San Juan Integrated School', 'type' => 'Integrated (Public)', 'is_public' => true],
            ['name' => 'Santiago North Central SPED Center', 'type' => 'Integrated (Public)', 'is_public' => true],
            ['name' => 'Sinili Integrated School', 'type' => 'Integrated (Public)', 'is_public' => true],

            // Private High School - 6 schools
            ['name' => 'University of La Salette, Inc.', 'type' => 'High School (Private)', 'is_public' => false],
            ['name' => 'Northeastern College (High School Dept.)', 'type' => 'High School (Private)', 'is_public' => false],
            ['name' => 'La Patria College of Santiago City', 'type' => 'High School (Private)', 'is_public' => false],
            ['name' => 'SISTECH College of Santiago', 'type' => 'High School (Private)', 'is_public' => false],
            ['name' => 'Global Academy of Technology and Entrepreneurship', 'type' => 'High School (Private)', 'is_public' => false],
            ['name' => 'AMA Computer College', 'type' => 'High School (Private)', 'is_public' => false],
        ];

        foreach ($schools as $i => $data) {
            $school = School::create([
                'name'         => $data['name'],
                'code'         => 'SCH' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                'type'         => $data['type'],
                'address'      => 'Santiago City, Isabela',
                'is_public'    => $data['is_public'],
            ]);

            // Create School Head for this school
            $head = User::create([
                'name'      => "Principal of {$data['name']}",
                'email'     => "school" . ($i + 1) . "@sdo-santiago.ph",
                'password'  => Hash::make('SchoolHead123!'),
                'school_id' => $school->id,
            ]);
            $head->assignRole('School Head');
        }

        $this->command->info('Created 58 schools + 58 School Heads + 2 Monitors + 1 Division Admin.');
    }
}
```
