<?php

$json = file_get_contents(__DIR__ . '/data.json');
$entries = json_decode($json, true, 512, JSON_THROW_ON_ERROR);

foreach ($entries as $entryData) {
    $section = $this->sections->getSectionByHandle('offer');
    $entryType = $section->getEntryTypes()[0];

    $entry = new Entry();
    $entry->sectionId = $section->id;
    $entry->typeId = $entryType->id;
    $entry->slug = $entryData['slug'];
    $entry->title = $entryData['title'];

    $entry->setFieldValues([
        'description' => $entryData['body'],
        // Set additional fields …
    ]);

    $success = Craft::$app->getElements()->saveElement($entry);

    if (!$success) {
        echo '### ERROR: FAILED SAVING ENTRY' . PHP_EOL;
        echo sprintf('Validation errors: %s', print_r($entry->getErrors(), true));
        return false;
    }
}
