<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = $this->getPermissions();

        foreach ($permissions as $permission) {
            Permission::firstOrCreate($permission);
        }

        $super_admin = Role::firstOrCreate(['name' => 'super-admin']);
        $super_admin->givePermissionTo(Permission::all());
        $advocate = Role::firstOrCreate(['name' => 'advocate']);

    }

    /**
     * This function returns an array of predefined permissions
     * @return array
     */
    private function getPermissions()
    {
        return [
            // User Management Permissions
            ['name' => 'view roles'],
            ['name' => 'add roles'],
            ['name' => 'edit roles'],
            ['name' => 'delete roles'],
            ['name' => 'view permissions'],
            ['name' => 'view users'],
            ['name' => 'add users'],
            ['name' => 'edit users'],
            ['name' => 'delete users'],
            ['name' => 'view profile'],
            ['name' => 'edit profile'],
            ['name' => 'view cle'],
            ['name' => 'add cle'],
            ['name' => 'edit cle'],
            ['name' => 'delete cle'],
            ['name' => 'view advocate commettee'],
            ['name' => 'add advocate commettee'],
            ['name' => 'edit advocate commettee'],
            ['name' => 'delete advocate commettee'],

            // Master Data Permissions
            ['name' => 'view master data'],
            ['name' => 'add master data'],
            ['name' => 'edit master data'],
            ['name' => 'delete master data'],

            // Reports Permissions
            ['name' => 'view statistical report'],
            ['name' => 'add statistical report'],
            ['name' => 'edit statistical report'],
            ['name' => 'delete statistical report'],

            ['name' => 'view petition report'],
            ['name' => 'add petition report'],
            ['name' => 'edit petition report'],
            ['name' => 'delete petition report'],

            ['name' => 'view permit report'],
            ['name' => 'add permit report'],
            ['name' => 'edit permit report'],
            ['name' => 'delete permit report'],

            ['name' => 'view advocate report'],
            ['name' => 'add advocate report'],
            ['name' => 'edit advocate report'],
            ['name' => 'delete advocate report'],

            ['name' => 'view temp admission report'],
            ['name' => 'add temp admission report'],
            ['name' => 'edit temp admission report'],
            ['name' => 'delete temp admission report'],

            ['name' => 'view revenue collection'],
            ['name' => 'add revenue collection'],
            ['name' => 'edit revenue collection'],
            ['name' => 'delete revenue collection'],

            // Payments & Bills Permissions
            ['name' => 'view pending bills'],
            ['name' => 'add pending bills'],
            ['name' => 'edit pending bills'],
            ['name' => 'delete pending bills'],

            ['name' => 'view paid bills'],
            ['name' => 'add paid bills'],
            ['name' => 'edit paid bills'],
            ['name' => 'delete paid bills'],

            ['name' => 'view expired bills'],
            ['name' => 'add expired bills'],
            ['name' => 'edit expired bills'],
            ['name' => 'delete expired bills'],

            ['name' => 'view cancelled bills'],
            ['name' => 'add cancelled bills'],
            ['name' => 'edit cancelled bills'],
            ['name' => 'delete cancelled bills'],

            // Temporary Admissions Permissions
            ['name' => 'view temp application'],
            ['name' => 'add temp application'],
            ['name' => 'edit temp application'],
            ['name' => 'delete temp application'],

            ['name' => 'view temp rhc review'],
            ['name' => 'add temp rhc review'],
            ['name' => 'edit temp rhc review'],
            ['name' => 'delete temp rhc review'],

            ['name' => 'view temp cj approval'],
            ['name' => 'add temp cj approval'],
            ['name' => 'edit temp cj approval'],
            ['name' => 'delete temp cj approval'],

            ['name' => 'view temp advocate'],
            ['name' => 'add temp advocate'],
            ['name' => 'edit temp advocate'],
            ['name' => 'delete temp advocate'],

            // Name Change Permissions
            ['name' => 'view name change frontdesk'],
            ['name' => 'add name change frontdesk'],
            ['name' => 'edit name change frontdesk'],
            ['name' => 'delete name change frontdesk'],

            ['name' => 'view name change rhc'],
            ['name' => 'add name change rhc'],
            ['name' => 'edit name change rhc'],
            ['name' => 'delete name change rhc'],

            ['name' => 'view name change jk'],
            ['name' => 'add name change jk'],
            ['name' => 'edit name change jk'],
            ['name' => 'delete name change jk'],

             // Not for Profit Permissions
             ['name' => 'view notfor profit frontdesk'],
             ['name' => 'add notfor profit frontdesk'],
             ['name' => 'edit notfor profit frontdesk'],
             ['name' => 'delete notfor profit frontdesk'],
 
             ['name' => 'view notfor profit rhc'],
             ['name' => 'add notfor profit rhc'],
             ['name' => 'edit notfor profit rhc'],
             ['name' => 'delete notfor profit rhc'],
 
             ['name' => 'view notfor profit cj'],
             ['name' => 'add notfor profit cj'],
             ['name' => 'edit notfor profit cj'],
             ['name' => 'delete notfor profit cj'],

             // Retiring Permissions
             ['name' => 'view retiring frontdesk'],
             ['name' => 'add retiring frontdesk'],
             ['name' => 'edit retiring frontdesk'],
             ['name' => 'delete retiring frontdesk'],
 
             ['name' => 'view retiring rhc'],
             ['name' => 'add retiring rhc'],
             ['name' => 'edit retiring rhc'],
             ['name' => 'delete retiring rhc'],
 
             ['name' => 'view retiring cj'],
             ['name' => 'add retiring cj'],
             ['name' => 'edit retiring cj'],
             ['name' => 'delete retiring cj'],

              // None Practising Permissions
              ['name' => 'view non practising frontdesk'],
              ['name' => 'add non practising frontdesk'],
              ['name' => 'edit non practising frontdesk'],
              ['name' => 'delete non practising frontdesk'],
  
              ['name' => 'view non practising rhc'],
              ['name' => 'add non practising rhc'],
              ['name' => 'edit non practising rhc'],
              ['name' => 'delete non practising rhc'],
  
              ['name' => 'view non practising cj'],
              ['name' => 'add non practising cj'],
              ['name' => 'edit non practising cj'],
              ['name' => 'delete non practising cj'],

              // Suspending Permissions
              ['name' => 'view suspending frontdesk'],
              ['name' => 'add suspending frontdesk'],
              ['name' => 'edit suspending frontdesk'],
              ['name' => 'delete suspending frontdesk'],
  
              ['name' => 'view suspending rhc'],
              ['name' => 'add suspending rhc'],
              ['name' => 'edit suspending rhc'],
              ['name' => 'delete suspending rhc'],
  
              ['name' => 'view suspending cj'],
              ['name' => 'add suspending cj'],
              ['name' => 'edit suspending cj'],
              ['name' => 'delete suspending cj'],

              // Resuming Practising Permissions
              ['name' => 'view resuminig frontdesk'],
              ['name' => 'add resuminig frontdesk'],
              ['name' => 'edit resuminig frontdesk'],
              ['name' => 'delete resuminig frontdesk'],
  
              ['name' => 'view resuminig rhc'],
              ['name' => 'add resuminig rhc'],
              ['name' => 'edit resuminig rhc'],
              ['name' => 'delete resuminig rhc'],
  
              ['name' => 'view resuminig cj'],
              ['name' => 'add resuminig cj'],
              ['name' => 'edit resuminig cj'],
              ['name' => 'delete resuminig cj'],

              // Out of Time Permissions
              ['name' => 'view outof time frontdesk'],
              ['name' => 'add outof time frontdesk'],
              ['name' => 'edit outof time frontdesk'],
              ['name' => 'delete outof time frontdesk'],
  
              ['name' => 'view outof time rhc'],
              ['name' => 'add outof time rhc'],
              ['name' => 'edit outof time rhc'],
              ['name' => 'delete outof time rhc'],
  
              ['name' => 'view outof time cj'],
              ['name' => 'add outof time cj'],
              ['name' => 'edit outof time cj'],
              ['name' => 'delete outof time cj'],

              // Firm& Workplaces Permissions
              ['name' => 'view firm pending approval'],
              ['name' => 'add firm pending approval'],
              ['name' => 'edit firm pending approval'],
              ['name' => 'delete firm pending approval'],
  
              ['name' => 'view law firm'],
              ['name' => 'add law firm'],
              ['name' => 'edit law firm'],
              ['name' => 'delete law firm'],
  
              ['name' => 'view business company'],
              ['name' => 'add business company'],
              ['name' => 'edit business company'],
              ['name' => 'delete business company'],

              ['name' => 'view government'],
              ['name' => 'add government'],
              ['name' => 'edit government'],
              ['name' => 'delete government'],

              ['name' => 'view plc'],
              ['name' => 'add plc'],
              ['name' => 'edit plc'],
              ['name' => 'delete plc'],

              ['name' => 'view ngo'],
              ['name' => 'add ngo'],
              ['name' => 'edit ngo'],
              ['name' => 'delete ngo'],

              ['name' => 'view others'],
              ['name' => 'add others'],
              ['name' => 'edit others'],
              ['name' => 'delete others'],

              // legal Professions Permissions
              ['name' => 'view legal professional'],
              ['name' => 'add legal professional'],
              ['name' => 'edit legal professional'],
              ['name' => 'delete legal professional'],

              // Miscellaneous Permissions
              ['name' => 'view postponed'],
              ['name' => 'add postponed'],
              ['name' => 'edit postponed'],
              ['name' => 'delete postponed'],
  
              ['name' => 'view deferred'],
              ['name' => 'add deferred'],
              ['name' => 'edit deferred'],
              ['name' => 'delete deferred'],
  
              ['name' => 'view objected'],
              ['name' => 'add objected'],
              ['name' => 'edit objected'],
              ['name' => 'delete objected'],

              ['name' => 'view abandoned'],
              ['name' => 'add abandoned'],
              ['name' => 'edit abandoned'],
              ['name' => 'delete abandoned'],

              // Resume Petition Permissions
              ['name' => 'view resume petition rhc'],
              ['name' => 'add resume petition rhc'],
              ['name' => 'edit resume petition rhc'],
              ['name' => 'delete resume petition rhc'],
  
              ['name' => 'view resume petition cle'],
              ['name' => 'add resume petition cle'],
              ['name' => 'edit resume petition cle'],
              ['name' => 'delete resume petition cle'],
  
              ['name' => 'view resume petition cj'],
              ['name' => 'add resume petition cj'],
              ['name' => 'edit resume petition cj'],
              ['name' => 'delete resume petition cj'],

              // Petition Permissions
              ['name' => 'view petition frontdesk'],
              ['name' => 'add petition frontdesk'],
              ['name' => 'edit petition frontdesk'],
              ['name' => 'delete petition frontdesk'],
  
              ['name' => 'view petition cle'],
              ['name' => 'add petition cle'],
              ['name' => 'edit petition cle'],
              ['name' => 'delete petition cle'],

              ['name' => 'view petition bar'],
              ['name' => 'add petition bar'],
              ['name' => 'edit petition bar'],
              ['name' => 'delete petition bar'],
  
              ['name' => 'view petition cj'],
              ['name' => 'add petition cj'],
              ['name' => 'edit petition cj'],
              ['name' => 'delete petition cj'],

              // Session Permissions
              ['name' => 'view session list'],
              ['name' => 'add session list'],
              ['name' => 'edit session list'],
              ['name' => 'delete session list'],
  
              ['name' => 'view cle session'],
              ['name' => 'add cle session'],
              ['name' => 'edit cle session'],
              ['name' => 'delete cle session'],

              ['name' => 'view bar exam'],
              ['name' => 'add bar exam'],
              ['name' => 'edit bar exam'],
              ['name' => 'delete bar exam'],
  
              ['name' => 'view cj interview'],
              ['name' => 'add cj interview'],
              ['name' => 'edit cj interview'],
              ['name' => 'delete cj interview'],

              ['name' => 'view objection views'],
              ['name' => 'add objection views'],
              ['name' => 'edit objection views'],
              ['name' => 'delete objection views'],

              ['name' => 'view pending admission'],
              ['name' => 'add pending admission'],
              ['name' => 'edit pending admission'],
              ['name' => 'delete pending admission'],
  
              ['name' => 'view venue management'],
              ['name' => 'add venue management'],
              ['name' => 'edit venue management'],
              ['name' => 'delete venue management'],
        ];
    }
}
