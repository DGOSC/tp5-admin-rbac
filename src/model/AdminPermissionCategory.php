<?php
/******************************************************************************
 * 描述：权限分类管理
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
 * 时间：16:38
 ******************************************************************************/

namespace dgosc\admin\rbac\model;

use think\Db;
use think\Exception;

class AdminPermissionCategory extends AdminBase
{

    /**
     ***************************************************************************************
     * 描述: 编辑权限分组
     * 函数: saveCategory
     * =====================================================================================
     * 作者: 武汉道广科技有限公司
     * 邮箱: dgosc@163.com
     * 日期：2020年12月01日 16:45
     * =====================================================================================
     * @param array $data
     * @return $this
     ***************************************************************************************
     */
    public function saveCategory($data = [])
    {
        if (!empty($data)) {
            $this->data($data);
        }
        $validate = new \dgosc\admin\rbac\validate\AdminPermissionCategory();
        if (!$validate->check($this)) {
            throw new Exception($validate->getError());
        }
        $data = $this->getData();
        if (isset($data['id']) && !empty($data['id'])) {
            $this->isUpdate(true);
        }
        $this->save();
        return $this;
    }

    /**
     ***************************************************************************************
     * 描述: 删除权限分组
     * 函数: delCategory
     * =====================================================================================
     * 作者: 武汉道广科技有限公司
     * 邮箱: dgosc@163.com
     * 日期：2020年12月01日 16:47
     * =====================================================================================
     * @param $id
     * @return bool
     ***************************************************************************************
     */
    public function delCategory($id)
    {
        $where = [];
        if (is_array($id)) {
            $where[] = ['id', 'IN', $id];
        } else {
            $id = (int)$id;
            if (is_numeric($id) && $id > 0) {
                $where[] = ['id', '=', $id];
            } else {
                throw new Exception('删除条件错误');
            }
        }

        if ($this->where($where)->delete() === false) {
            throw new Exception('删除权限分组出错');
        }
        return true;
    }

    /**
     ***************************************************************************************
     * 描述: 获取权限分组
     * 函数: getCategory
     * =====================================================================================
     * 作者: 武汉道广科技有限公司
     * 邮箱: dgosc@163.com
     * 日期：2020年12月01日 16:48
     * =====================================================================================
     * * @param $where
     * @return mixed
     ***************************************************************************************
     */
    public function getCategory($where)
    {
        $model = Db::name('admin_permission_category')->setConnection($this->getConnection());
        if (is_numeric($where)) {
            return $model->where('id', $where)->find();
        } else {
            return $model->where($where)->select();
        }
    }
}