<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LaratrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return  void
     */
    public function run()
    {
        $this->command->info('Truncating User, Role and Permission tables');
        $this->truncateLaratrustTables();

        $config = config('laratrust_seeder.role_structure');
        $userPermission = config('laratrust_seeder.permission_structure');
        $mapPermission = collect(config('laratrust_seeder.permissions_map'));

        foreach ($config as $key => $modules) {

            // Create a new role
            $role = \App\Role::create([
                'name' => $key,
                'display_name' => ucwords(str_replace('_', ' ', $key)),
                'description' => ucwords(str_replace('_', ' ', $key))
            ]);
            $permissions = [];

            $this->command->info('Creating Role '. strtoupper($key));

            // Reading role permission modules
            foreach ($modules as $module => $value) {

                foreach (explode(',', $value) as $p => $perm) {

                    $permissionValue = $mapPermission->get($perm);

                    $permissions[] = \App\Permission::firstOrCreate([
                        'name' => $permissionValue . '-' . $module,
                        'display_name' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                        'description' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                    ])->id;

                    $this->command->info('Creating Permission to '.$permissionValue.' for '. $module);
                }
            }

            // Attach all permissions to the role
            $role->permissions()->sync($permissions);

            $this->command->info("Creating '{$key}' user");

            // Create default user for each role
            $user = \App\User::create([
                'nip' => random_int(1,9999999999999999),
                'address' => 'Jl. Basuki Rahmat I Lrg. Menara I No. 04 Palu',
                'place_birth' => 'Lumajang',
                'date_birth' => '1984-08-26',
                'religion' => 'islam',
                'gender' => 'Laki-laki',
                'name' => 'Aditya Dwiantoro',
                'email' => $key.'adityadwiantoro@gmail.com',
                'password' => bcrypt('badandiklat')
            ]);

            $user->attachRole($role);
        }

        // Creating user with permissions
        if (!empty($userPermission)) {

            foreach ($userPermission as $key => $modules) {

                foreach ($modules as $module => $value) {

                    // Create default user for each permission set
                    $user = \App\User::create([
                        'nip' => random_int(1,9999999999999999),
                        'address' => 'Jl. Basuki Rahmat I Lrg. Menara I No. 04 Palu',
                        'place_birth' => 'Lumajang',
                        'date_birth' => '1984-08-26',
                        'religion' => 'islam',
                        'gender' => 'Laki-laki',
                        'name' => 'Aditya Dwiantoro',
                        'email' => $key.'adityadwiantoro@gmail.com',
                        'password' => bcrypt('badandiklat')
                    ]);
                    $permissions = [];

                    foreach (explode(',', $value) as $p => $perm) {

                        $permissionValue = $mapPermission->get($perm);

                        $permissions[] = \App\Permission::firstOrCreate([
                            'name' => $permissionValue . '-' . $module,
                            'display_name' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                            'description' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                        ])->id;

                        $this->command->info('Creating Permission to '.$permissionValue.' for '. $module);
                    }
                }

                // Attach all permissions to the user
                $user->permissions()->sync($permissions);
            }
        }
        // my custom permission
        $perm = \App\Permission::create([
            'name' => 'management-diklat',
            'display_name' => 'management-diklat',
            'description' => 'permission for showing management diklat menu title'
        ]);

        $perm = \App\Permission::create([
            'name' => 'show-subjects',
            'display_name' => 'show-subjects',
            'description' => 'permission for showing training subjects'
        ]);

        $perm = \App\Permission::create([
            'name' => 'create-subjects',
            'display_name' => 'create-subjects',
            'description' => 'permission for creating training subjects'
        ]);

        $perm = \App\Permission::create([
            'name' => 'update-subjects',
            'display_name' => 'update-subjects',
            'description' => 'permission for updating training subjects'
        ]);

        $perm = \App\Permission::create([
            'name' => 'delete-subjects',
            'display_name' => 'delete-subjects',
            'description' => 'permission for deleting training subjects'
        ]);

        $perm = \App\Permission::create([
            'name' => 'show-speakers',
            'display_name' => 'show-speakers',
            'description' => 'permission for showing speakers of training'
        ]);

        $perm = \App\Permission::create([
            'name' => 'create-speakers',
            'display_name' => 'create-speakers',
            'description' => 'permission for creating speakers of training'
        ]);

        $perm = \App\Permission::create([
            'name' => 'update-speakers',
            'display_name' => 'update-speakers',
            'description' => 'permission for updateing speakers of training'
        ]);

        $perm = \App\Permission::create([
            'name' => 'delete-speakers',
            'display_name' => 'delete-speakers',
            'description' => 'permission for deleting speakers of training'
        ]);

        $perm = \App\Permission::create([
            'name' => 'show-trainings',
            'display_name' => 'show-trainings',
            'description' => 'permission for showing training'
        ]);

        $perm = \App\Permission::create([
            'name' => 'create-trainings',
            'display_name' => 'create-trainings',
            'description' => 'permission for creating training'
        ]);

        $perm = \App\Permission::create([
            'name' => 'update-trainings',
            'display_name' => 'update-trainings',
            'description' => 'permission for updating training'
        ]);

        $perm = \App\Permission::create([
            'name' => 'delete-trainings',
            'display_name' => 'delete-trainings',
            'description' => 'permission for deleting training'
        ]);

        $perm = \App\Permission::create([
            'name' => 'create-training-schedule',
            'display_name' => 'create-training-schedule',
            'description' => 'permission for creating training schedules'
        ]);

        $perm = \App\Permission::create([
            'name' => 'show-management-participant',
            'display_name' => 'show management participant',
            'description' => 'permission for showing management participant'
        ]);

        // my custom role
        $role = \App\Role::create([
            'name' => 'widyaiswara',
            'display_name' => 'Widyaiswara',
            'description' => 'speakers role'
        ]);

        $role = \App\Role::create([
            'name' => 'admin-bkpsdm',
            'display_name' => 'admin-bkpsdm',
            'description' => 'role for admin bkpsdm'
        ]);
    }

    /**
     * Truncates all the laratrust tables and the users table
     *
     * @return    void
     */
    public function truncateLaratrustTables()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('permission_role')->truncate();
        DB::table('permission_user')->truncate();
        DB::table('role_user')->truncate();
        \App\User::truncate();
        \App\Role::truncate();
        \App\Permission::truncate();
        Schema::enableForeignKeyConstraints();
    }
}
