<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;
use App\Services\DeleteSubDomainService;
use App\Services\DeleteDatabaseService;


class InstanceCancellingService
{

    public function cancelInstance($name_instance)
    {
        //Suppression sous-domaine
        $new_delete_SubDomain = new DeleteSubDomainService();
        $action_Delete_Subdomain = $new_delete_SubDomain->deleteSubdomain($name_instance);
        
        //Suppression base de donnée
        $new_delete_Database = new DeleteDatabaseService();
        $action_delete_Database = $new_delete_Database->deleteDatabase($name_instance);
        
        require_once base_path('app/Services/DeleteDirectoryService.php');
    
        $delete_directory = deleteDirectory('/home/sc2sylg/Instance/'.$name_instance.'.erpinnov.com');
        
        return true;
        
    }
}
