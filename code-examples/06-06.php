<?php

/**
 * UserPermissions::EVENT_REGISTER_PERMISSIONS
 */
public function defineWorkflowPermissions(RegisterUserPermissionsEvent $event)
{
    $section = Craft::$app->sections->getSectionByHandle('offer');
    $entryTypes = $section->getEntryTypes();

    $entryTypePermissions = [];
    foreach ($entryTypes as $entryType) {
        $permission = 'workflowAccess:' . $entryType->uid;
        $entryTypePermissions[$permission] = [
            'label' => "Access entry type {$entryType->name}"
        ];
    }

    $event->permissions[] = [
        'heading' => 'Custom workflows',
        'permissions' => $entryTypePermissions,
    ];
}