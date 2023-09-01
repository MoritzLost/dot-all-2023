<?php

/**
 * Entry::EVENT_DEFINE_ENTRY_TYPES
 */
public function limitEntryTypesByUserGroup(DefineEntryTypesEvent $e)
{
    $user = Craft::$app->getUser()->getIdentity();
    if (!$user) {
        return;
    }

    if ($e->sender->getSection()->handle !== 'offer') {
        return;
    }

    $allowedEntryTypes = array_filter(
        $e->entryTypes,
        fn (EntryType $entryType) => $user->can('workflowAccess:' . $entryType->uid),
    );

    $e->entryTypes = $allowedEntryTypes;
}