<?php
namespace database\seeds;

use Illuminate\Database\Seeder;
use App\Models\AclPermissionsModel;

class AclPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaults_permissions = [
        	['name'=>'visualizar_usuarios', 'label'=>'Visualizar Usuários', 'group'=>'usuarios'],
			['name'=>'editar_usuarios', 'label'=>'Editar Usuários', 'group'=>'usuarios'],
			['name'=>'excluir_usuarios', 'label'=>'Excluir Usuários', 'group'=>'usuarios'],
			['name'=>'habilitar_usuarios', 'label'=>'Habilitar Usuários', 'group'=>'usuarios'],
			['name'=>'visualizar_perfils', 'label'=>'Visualizar Perfils', 'group'=>'perfis'],
			['name'=>'adicionar_perfils', 'label'=>'Adicionar Perfils', 'group'=>'perfis'],
			['name'=>'editar_perfils', 'label'=>'Editar Perfils', 'group'=>'perfis'],
			['name'=>'excluir_perfils', 'label'=>'Excluir Perfils', 'group'=>'perfis'],
			['name'=>'adicionar_produtos', 'label'=>'Adicionar Produtos', 'group'=>'produtos'],
			['name'=>'editar_produtos', 'label'=>'Editar Produtos', 'group'=>'produtos'],
			['name'=>'excluir_produtos', 'label'=>'Excluir Produtos', 'group'=>'produtos'],
			['name'=>'criar_usuarios', 'label'=>'Criar Usuários', 'group'=>'usuarios'],
        ];

        foreach ($defaults_permissions as $key => $permissions) {
        	$AclPermissions = new AclPermissionsModel();
        	$AclPermissions->name = $permissions['name'];
        	$AclPermissions->label = $permissions['label'];
        	$AclPermissions->group = $permissions['group'];
        	$AclPermissions->save();
        }
    }
}
