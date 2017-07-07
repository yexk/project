<?php

if (!function_exists('get_tree')) {
    /**
     * 使用递归，获取树状结构
     * 如果传入第二个参数代表排除自己的子集
     * @param  array  $data  表单接受的数据
     * @param  number $pid   父级id
     * @param  number $selfid 当前点击的id
     * @param  number $level 等级（数据的层级结构）
     * @return return array    返回一个数组
     */
    function get_tree($data,$selfid=-1,$pid = 0,$level = 0)
    {
        static $arr = array();
        foreach ($data as $k => $v)
        {
            if ($v['pid'] == $pid)
            {
                $v['level'] = $level;
                $arr[] = $v;
                if ($v['id'] == $selfid) continue;
                get_tree($data, $selfid, $v['id'], $level+1);
            }
        }
        return $arr;
    }
}

if (!function_exists('get_sub_tree')) {
    /**
     * 使用递归，获取树状结构
     * 如果传入第二个参数代表排除自己的子集
     * @param  array  $data  表单接受的数据
     * @param  number $selfid 当前点击的id
     * @return return array    返回一个子集数组
     */
    function get_sub_tree($data,$selfid=-1)
    {
        static $arr = array();
        foreach ($data as $k => $v)
        {
            if ( $v['pid'] == $selfid )
            {
                $arr[] = $v;
                get_sub_tree($data,$v['id']);
            }
        }
        return $arr;
    }
}
