<?php

/**
 * User::EVENT_AFTER_LOGIN
 */
public function ensureDefaultDashboardWidgets(User $user): void
{
    $existingWidgets = Craft::$app->dashboard->getAllWidgets();
    foreach ($existingWidgets as $widget) {
        Craft::$app->dashboard->deleteWidget($widget);
    }

    $defaultWidgets = [
        Craft::$app->dashboard->createWidget([
            'type' => 'modules\\Workflow\\widgets\\AdminNotes',
            'colspan' => 2,
        ]),
        Craft::$app->dashboard->createWidget(
            'modules\\Workflow\\widgets\\Shortcuts'
        ),
        Craft::$app->dashboard->createWidget(
            'modules\\Workflow\\widgets\\QuickLinks'
        ),
        // More widgets …
    ];

    foreach ($defaultWidgets as $widget) {
        Craft::$app->dashboard->saveWidget($widget);
    }
}