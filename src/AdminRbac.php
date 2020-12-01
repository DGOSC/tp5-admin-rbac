<?php
/******************************************************************************
 * 描述：后台管理RBAC
 * 文件：AdminRbac.php
 * ============================================================================
 * 版权所有 2007-2019 武汉道广科技有限公司，并保留所有权利。
 * 网站地址: http://www.dgosc.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * 作者: fengqing7211
 * 日期：2020年12月01日
 * 时间：09:15
 ******************************************************************************/

namespace  dgosc\admin\rbac;

use dgosc\nestedsets\NestedSets;
use dgosc\admin\rbac\model\Permission;
use dgosc\admin\rbac\model\PermissionCategory;
use dgosc\admin\rbac\model\Role;
use dgosc\admin\rbac\model\UserRole;
use think\Db;
use think\db\Query;
use think\db\Where;
use think\Exception;
use think\facade\Cache;
use think\facade\Request;
use think\facade\Session;

class AdminRbac
{
    private $type = "service";
    private $db = '';
    private $saltToken = 'asdfqet9#$@#GS#$%080asdfaasdg';
    private $tokenKey = 'Authorization';

    /**
     * AdminRbac constructor.
     */
    public function __construct()
    {
        $rbacConfig = config('rbac');
        if (!empty($rbacConfig)) {
            isset($rbacConfig['db']) && $this->db = $rbacConfig['db'];
            isset($rbacConfig['type']) && $this->type = $rbacConfig['type'];
            isset($rbacConfig['salt_token']) && $this->saltToken = $rbacConfig['salt_token'];
            isset($rbacConfig['token_key']) && $this->tokenKey = $rbacConfig['token_key'];
        }

    }

    /**
     ***************************************************************************************
     * 描述: 创建数据表
     * 函数: createTable
     * =====================================================================================
     * 作者: 武汉道广科技有限公司
     * 邮箱: dgosc@163.com
     * 日期：2020年12月01日 09:34
     * =====================================================================================
     * * @param string $db
     ***************************************************************************************
     */
    public function createTable($db = '')
    {
        $createTable = new AdminCreateTable();
        $createTable->create($db);
    }

    /**
     ***************************************************************************************
     * 描述: 配置参数
     * 函数: setDb
     * =====================================================================================
     * 作者: 武汉道广科技有限公司
     * 邮箱: dgosc@163.com
     * 日期：2020年12月01日 09:35
     * =====================================================================================
     * * @param string $db
     ***************************************************************************************
     */
    public function setDb($db = '')
    {
        $this->db = $db;
    }

    public function createPermission(array $data = [])
    {
        $model = new AdminPermission($this->db);
        $model->data($data);
        try{
            $res = $model->savePermission();
            return $res;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}