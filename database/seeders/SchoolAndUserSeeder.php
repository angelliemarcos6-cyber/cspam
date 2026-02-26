<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\School;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SchoolAndUserSeeder extends Seeder
{
    public function run(): void
    {
        // ─── ENSURE ALL REQUIRED ROLES EXIST ────────────────────────────────
        $roles = [
            'Division Admin',
            'SMM&E Monitor',
            'School Head',
        ];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // ─── DIVISION ADMIN ──────────────────────────────────────────────────
        $admin = User::firstOrCreate(
            ['email' => 'admin@sdo-santiago.ph'],
            [
                'name'      => 'Division Admin',
                'password'  => Hash::make('Admin123!'),
                                     'school_id' => null,
            ]
        );
        $admin->assignRole('Division Admin');

        // ─── SMM&E MONITORS ─────────────────────────────────────────────────
        $monitorsData = [
            [
                'name'     => 'Arcadio L. Modumo, JR',
                'email'    => 'monitor1@sdo-santiago.ph',
                'password' => 'Monitor123!',
            ],
            [
                'name'     => 'Shirlyn R. Macaspac',
                'email'    => 'monitor2@sdo-santiago.ph',
                'password' => 'Monitor123!',
            ],
        ];

        foreach ($monitorsData as $data) {
            $monitor = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name'      => $data['name'],
                    'password'  => Hash::make($data['password']),
                                           'school_id' => null,
                ]
            );
            $monitor->assignRole('SMM&E Monitor');
        }

        // ─── SCHOOLS + SCHOOL HEADS ─────────────────────────────────────────
        $schoolsData = [
            // Elementary (Public) – 30
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

            // Elementary (Private) – 8
            ['name' => 'University of La Salette (ULS) Grade School Department', 'type' => 'Elementary (Private)', 'is_public' => false],
            ['name' => 'Top Achievers Private School - Santiago Campus', 'type' => 'Elementary (Private)', 'is_public' => false],
            ['name' => 'Children First School (CFS) - Santiago Campus', 'type' => 'Elementary (Private)', 'is_public' => false],
            ['name' => 'Santiago Cultural Institute', 'type' => 'Elementary (Private)', 'is_public' => false],
            ['name' => 'Infant Jesus Montessori School', 'type' => 'Elementary (Private)', 'is_public' => false],
            ['name' => 'Kiddie Toes Montessori School', 'type' => 'Elementary (Private)', 'is_public' => false],
            ['name' => 'Galilee Integrated School', 'type' => 'Elementary (Private)', 'is_public' => false],
            ['name' => 'Sefton Village Christian School', 'type' => 'Elementary (Private)', 'is_public' => false],

            // Public High School – 7
            ['name' => 'Santiago City National High School', 'type' => 'High School (Public)', 'is_public' => true],
            ['name' => 'Cabulay High School', 'type' => 'High School (Public)', 'is_public' => true],
            ['name' => 'Naggasican National High School', 'type' => 'High School (Public)', 'is_public' => true],
            ['name' => 'Rizal National High School', 'type' => 'High School (Public)', 'is_public' => true],
            ['name' => 'Rosario National High School', 'type' => 'High School (Public)', 'is_public' => true],
            ['name' => 'Sagana National High School', 'type' => 'High School (Public)', 'is_public' => true],
            ['name' => 'Sinsayon National High School', 'type' => 'High School (Public)', 'is_public' => true],

            // Integrated (Public) – 7
            ['name' => 'Balintocatoc Integrated School', 'type' => 'Integrated (Public)', 'is_public' => true],
            ['name' => 'Bannaway Norte Integrated School', 'type' => 'Integrated (Public)', 'is_public' => true],
            ['name' => 'Nabuan Integrated School', 'type' => 'Integrated (Public)', 'is_public' => true],
            ['name' => 'Salvador Integrated School', 'type' => 'Integrated (Public)', 'is_public' => true],
            ['name' => 'San Juan Integrated School', 'type' => 'Integrated (Public)', 'is_public' => true],
            ['name' => 'Santiago North Central SPED Center', 'type' => 'Integrated (Public)', 'is_public' => true],
            ['name' => 'Sinili Integrated School', 'type' => 'Integrated (Public)', 'is_public' => true],

            // Private High School – 6
            ['name' => 'University of La Salette, Inc.', 'type' => 'High School (Private)', 'is_public' => false],
            ['name' => 'Northeastern College (High School Dept.)', 'type' => 'High School (Private)', 'is_public' => false],
            ['name' => 'La Patria College of Santiago City', 'type' => 'High School (Private)', 'is_public' => false],
            ['name' => 'SISTECH College of Santiago', 'type' => 'High School (Private)', 'is_public' => false],
            ['name' => 'Global Academy of Technology and Entrepreneurship', 'type' => 'High School (Private)', 'is_public' => false],
            ['name' => 'AMA Computer College', 'type' => 'High School (Private)', 'is_public' => false],
        ];

        foreach ($schoolsData as $index => $data) {
            $school = School::firstOrCreate(
                ['name' => $data['name']],
                [
                    'code'      => 'SCH' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                                            'type'      => $data['type'],
                                            'address'   => 'Santiago City, Isabela',
                                            'is_public' => $data['is_public'],
                ]
            );

            $headEmail = "school" . ($index + 1) . "@sdo-santiago.ph";

            $head = User::firstOrCreate(
                ['email' => $headEmail],
                [
                    'name'      => "Principal / Head Teacher - " . $data['name'],
                    'password'  => Hash::make('SchoolHead123!'),
                                        'school_id' => $school->id,
                ]
            );

            $head->assignRole('School Head');
        }

        // ─── SUMMARY ─────────────────────────────────────────────────────────
        $totalSchools = count($schoolsData);
        $this->command->info("Seeded: 1 Division Admin + 2 SMM&E Monitors + {$totalSchools} schools + {$totalSchools} School Heads.");
    }
}
