<?php
/******************************************************************************
 * 描述：管理员权限分类
 * 文件：AdminPermissionCategory.php
 * ============================================================================
 * 版权所有 2007-2019 武汉道广科技有限公司，并保留所有权利。
 * 网站地址: http://www.dgosc.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * 作者: Nginx
 * 日期：2020年12月01日
 * 时间：16:41
 ******************************************************************************/

namespace dgosc\admin\rbac\validate;

use think\Validate;

class AdminPermissionCategoryValidate extends  Validate
{
    protected $rule = [
        'name' => 'require|max:50|unique:dgosc\admin\rbac\model\adminpermissioncategory,name',
    ];

    protected $message = [
        'name.require' => '分组名不能为空',
        'name.max' => '分组名不能长于50个字符',
        'name.unique' => '分组名称不能重复',
    ];

}