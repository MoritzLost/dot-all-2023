
<?php

/**
* Entries::EVENT_DEFINE_SELECTION_CRITERIA
*/
public function allowDraftsAsRelatedInstitute(ElementCriteriaEvent $e): void
{
    if ($e->sender->handle !== 'institutes') {
        return;
    }

    $e->criteria = [
        'drafts' => null,
        'draftOf' => false,
        'savedDraftsOnly' => true,
    ];
}