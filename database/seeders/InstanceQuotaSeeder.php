<?php

namespace Database\Seeders;

use App\Models\InstanceQuota;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstanceQuotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer l'abonnement
        DB:table('instance_quotas')->insert([
            [
                'url' => 'https://002.erpinnov.com',
                'password' => '9P#&Wz&$hZ',
                'api_key' => 'zkh93SPSpEVHrBjTNNFGLiCiXbAvYdMi',
                'statut' => 'attribué',
                'db_name' => 'sc2sylg_002',
                'db_user' => 'sc2sylg_002',
                'db_pass' => 'S4[pa]1X39',
                'prefix' => 'llx2n_',
                'instanceId' => '3d6b52fbc7718ec8c1a8fdb204a9a626'
            ],
            [
                'url' => 'https://003.erpinnov.com',
                'password' => '5i1AZ@&4l0',
                'api_key' => 'NmGSZopC47O9PMgLMO8NQo6AKLXbpBxT',
                'statut' => 'attribué',
                'db_name' => 'sc2sylg_doli318',
                'db_user' => 'sc2sylg_doli318',
                'db_pass' => 'q!7ShZ@78p',
                'prefix' => 'llxo6_',
                'instanceId' => '0f9f12186057a9638f79894636491e18'
            ],
            [
                'url' => 'https://004.erpinnov.com',
                'password' => '%2&&CbtEvT',
                'api_key' => 'aoIG84aQCfUq2bSO83Y35LztWW5Q9Hi8',
                'statut' => 'attribué',
                'db_name' => 'sc2sylg_doli463',
                'db_user' => 'sc2sylg_doli463',
                'db_pass' => 'S]58AXo1[p',
                'prefix' => 'llxk3_',
                'instanceId' => 'b438ca7103a5b49721b2134a6e2dd97b'
            ],
            [
                'url' => 'https://005.erpinnov.com',
                'password' => 'J7ahv9Str%',
                'api_key' => 'YrwLXs1OUEoyAwyFwuOjrUCGM98XcpkR',
                'statut' => 'attribué',
                'db_name' => 'sc2sylg_doli944',
                'db_user' => 'sc2sylg_doli944',
                'db_pass' => '@VV75S3e.p',
                'prefix' => 'llxfr_',
                'instanceId' => '087f997d198f758a941de5cd81cd75a0'
            ],
            [
                'url' => 'https://006.erpinnov.com',
                'password' => 'J@9yJ1c57h',
                'api_key' => 'uySmRK3Sr1AvmvxlbwwaKO674lRGodQt',
                'statut' => 'attribué',
                'db_name' => 'sc2sylg_doli266',
                'db_user' => 'sc2sylg_doli266',
                'db_pass' => 'S7[1M0Lp)x',
                'prefix' => 'llxha_',
                'instanceId' => '3c4f89bfbd79213e615617f23aaa062b'
            ]
        ]);
    }
}
