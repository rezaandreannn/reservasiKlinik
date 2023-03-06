<?php
if (! function_exists('groups_has_permission')) {
    /**
     * Ensures that the current user has the passed in permission.
     * The permission can be passed in either as an ID or name.
     *
     * @param int|string $permission
     */
    function groups_has_permission($groupId, $permissionId): bool
    {
       
        $db = \Config\Database::connect();
        return $db->table('auth_groups_permissions')
            ->where(['group_id' => $groupId, 'permission_id' => $permissionId])
            ->countAllResults() > 0 ? true : false ;

    }

    function users_has_groups($userId, $GroupId): bool
    {
       
        $db = \Config\Database::connect();
        return $db->table('auth_groups_users')
            ->where(['group_id' => $GroupId, 'user_id' => $userId])
            ->countAllResults() > 0 ? true : false ;

    }
}