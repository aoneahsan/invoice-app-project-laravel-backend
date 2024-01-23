<?php

namespace App\Zaions\Enums;

enum PermissionsEnum: string
{
        // Role
    case viewAny_role = 'viewAny_role';
    case view_role = 'view_role';
    case create_role = 'create_role';
    case update_role = 'update_role';
    case delete_role = 'delete_role';
    case replicate_role = 'replicate_role';
    case restore_role = 'restore_role';
    case forceDelete_role = 'forceDelete_role';

        // Permission
    case viewAny_permission = 'viewAny_permission';
    case view_permission = 'view_permission';
    case create_permission = 'create_permission';
    case update_permission = 'update_permission';
    case delete_permission = 'delete_permission';
    case replicate_permission = 'replicate_permission';
    case restore_permission = 'restore_permission';
    case forceDelete_permission = 'forceDelete_permission';

        // User
    case viewAny_user = 'viewAny_user';
    case view_user = 'view_user';
    case create_user = 'create_user';
    case update_user = 'update_user';
    case delete_user = 'delete_user';
    case replicate_user = 'replicate_user';
    case restore_user = 'restore_user';
    case forceDelete_user = 'forceDelete_user';

        // Invoice
    case viewAny_invoice = 'viewAny_invoice';
    case view_invoice = 'view_invoice';
    case create_invoice = 'create_invoice';
    case update_invoice = 'update_invoice';
    case delete_invoice = 'delete_invoice';
    case download_invoice = 'download_invoice';
    case replicate_invoice = 'replicate_invoice';
    case restore_invoice = 'restore_invoice';
    case forceDelete_invoice = 'forceDelete_invoice';

        // Client
    case viewAny_client = 'viewAny_client';
    case view_client = 'view_client';
    case create_client = 'create_client';
    case update_client = 'update_client';
    case delete_client = 'delete_client';
    case replicate_client = 'replicate_client';
    case restore_client = 'restore_client';
    case forceDelete_client = 'forceDelete_client';

        // User Detail
    case viewAny_user_detail = 'viewAny_user_detail';
    case view_user_detail = 'view_user_detail';
    case create_user_detail = 'create_user_detail';
    case update_user_detail = 'update_user_detail';
    case delete_user_detail = 'delete_user_detail';
    case replicate_user_detail = 'replicate_user_detail';
    case restore_user_detail = 'restore_user_detail';
    case forceDelete_user_detail = 'forceDelete_user_detail';

        // Impersonation
    case can_impersonate = 'can_impersonate';
    case canBe_impersonate = 'canBe_impersonate';

    // case viewAny_ = 'viewAny_';
    // case view_ = 'view_';
    // case create_ = 'create_';
    // case update_ = 'update_';
    // case delete_ = 'delete_';
    // case replicate_ = 'replicate_';
    // case restore_ = 'restore_';
    // case forceDelete_ = 'forceDelete_';
}
