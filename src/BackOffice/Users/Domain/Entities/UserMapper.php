<?php
namespace App\BackOffice\Users\Domain\Entities;

use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Configuration\AutoMapperConfigInterface;
use AutoMapperPlus\NameConverter\NamingConvention\CamelCaseNamingConvention;
use AutoMapperPlus\NameConverter\NamingConvention\SnakeCaseNamingConvention;

class UserMapper
{
    public AutoMapperInterface $autoMapper;
    public AutoMapperConfigInterface $config;

    public function __construct(AutoMapperInterface $autoMapper)
    {
        $this->autoMapper = $autoMapper;
        $this->config = $this->autoMapper->getConfiguration();
        $this->registerMapping();
    }

    public function registerMapping()
    {
        $this->config->registerMapping('array', LoginDTO::class)->withNamingConventions(
            new SnakeCaseNamingConvention(),
            new CamelCaseNamingConvention()
        )->forMember('activeName', function ($source) {
            return ($source['active'] == true)? 'SI' : 'NO';
        })->forMember('createdAt', function ($source) {
            $time = strtotime($source['created_at']);
            return date('d-m-Y H:i:s', $time);
        })->forMember('id', function($source){
            return $source['uuid'];
        });

        $this->config->registerMapping('array', UserInfoDto::class)->withNamingConventions(
            new SnakeCaseNamingConvention(),
            new CamelCaseNamingConvention()
        )->forMember('role', function ($source) {
            return $source['user_type']['name'];
        })->forMember('id', function($source){
            return $source['uuid'];
        })->forMember('email', function($source){
            return $source['email'];
        })->forMember('fullname', function($source){
            return $source['first_name']." ".$source['last_name'];
        })->forMember('permissions', function($source){
            return $source['menu'];
//            $menu = [];
//            $permissions = $source['user_type']['permissions'];
//
//            $permissionParents = array_filter($permissions, function($obj){
//                if(isset($obj['is_parent'])){
//                    $isParent = (bool) $obj['is_parent'];
//                    if($isParent === false){
//                        return false;
//                    }
//                }
//                return true;
//            });

//            $permissionChildren = array_filter($permissions, function($obj) {
//                if(isset($obj['is_children'])){
//                    $isChildren = $obj['is_children'];
//                    if($isChildren === 0){
//                        return false;
//                    }
//                }
//                return true;
//            });


//            if(count($permissionParents) > 0){
//
//                foreach($permissionParents as $parents) {
////                    $userMenuDto = new UserMenuDto();
////                    $userMenuDto->setId($parents['uuid']);
////                    $userMenuDto->setSlug(($parents['slug'] != "")? $parents['slug']: '' );
////                    $userMenuDto->setIcon(($parents['icon'] != "")? $parents['icon']: '' );
////                    $userMenuDto->setIsParent(($parents['is_parent'] != "")? $parents['is_parent']: '' );
////                    $userMenuDto->setIsChildren(($parents['is_children'] != "")? $parents['is_children']: '' );
////                    $userMenuDto->setOrder(($parents['order'] != -1)? $parents['order']: 0 );
////                    $userMenuDto->setName($parents['name']);
//
////                    $id = $parents['id'];
////
////                    $subMenu = [];
////
////                    if(count($permissionParents) > 0){
////                        foreach ($permissionChildren as $permission) {
////                            if($parents['id'] === $permission['parent_id']){
////                                $userMenuDtosub = new UserMenuDto();
////                                $userMenuDtosub->setId($permission['uuid']);
////                                $userMenuDtosub->setSlug(($permission['slug'] != "")? $permission['slug']: '' );
////                                $userMenuDtosub->setIcon(($permission['icon'] != "")? $permission['icon']: '' );
////                                $userMenuDtosub->setIsParent(($permission['is_parent'] != "")? $permission['is_parent']: '' );
////                                $userMenuDtosub->setIsChildren(($permission['is_children'] != "")? $permission['is_children']: '' );
////                                $userMenuDtosub->setOrder(($permission['order'] != -1)? $permission['order']: 0 );
////                                $userMenuDtosub->setName($permission['name']);
////                                $subMenu[] = $userMenuDtosub;
////                            }
////
////                        }
////                    }
////
////
////                    $userMenuDto->setSubmenu($subMenu);
//                    $menu[] = $userMenuDto;
//                }
//            }

//            if(count($permissions) > 0){
//
//                $parentId = '';
//                foreach($permissions as $permission) {
//
//                    $userMenuDto = new UserMenuDto();
//                    $userMenuDto->setId($permission['uuid']);
//
////                    if($parentId == ''){
////                        $parentId = $permission['uuid'];
////                    }
//
//                    if($permission['id'] == $permission['parent_id']) {
//                        $userMenuDto->setIdParent($permission['uuid']);
//                    } else {
//                        $userMenuDto->setIdParent('0');
//                    }
//
////                    if($parentId == $permission['parent_id'] && $parentId != ""){
////                        $userMenuDto->setIdParent($permission['uuid']);
////                    } else {
////                        $parentId = $permission['id'];
////                        $userMenuDto->setIdParent('');
////                    }
//
////                    $userMenuDto->setSlug(($permission['slug'] != "")? $permission['slug']: '' );
////                    $userMenuDto->setIcon(($permission['icon'] != "")? $permission['icon']: '' );
////                    $userMenuDto->setIsParent(($permission['is_parent'] != "")? $permission['is_parent']: '' );
////                    $userMenuDto->setIsChildren(($permission['is_children'] != "")? $permission['is_children']: '' );
////                    $userMenuDto->setOrder(($permission['order'] != -1)? $permission['order']: 0 );
////                    $userMenuDto->setName($permission['name']);
////                    $menu[] = $userMenuDto;
//                }
//            }
//            return $menu;

        });

    }
}