<?php

/**
 * Entry::EVENT_AFTER_SAVE
 */
public function changeAssetAuthorWithEntry(ModelEvent $e)
{
    if (ElementHelper::isDraftOrRevision($e->sender)) {
        return;
    }

    $authorHasChanged = in_array('authorId', $e->sender->getDirtyAttributes());
    if (!$authorHasChanged) {
        return;
    }

    $affectedAssets = Asset::find()->relatedTo([
        'sourceElement' => $e->sender->id,
        'field' => ['user_image', 'user_logo', 'user_files'],
    ])->all();

    foreach ($affectedAssets as $asset) {
        $asset->uploaderId = $e->sender->authorId;
        Craft::$app->elements->saveElement($asset);
    }
}