<?php

/**
 * Normalize the given value to a string representation.
 */
public function normalizeValue(mixed $value): string
{
    if (is_array($value)) {
        $value = implode(PHP_EOL, array_map($this->normalizeValue(...), $value));
    }
    if (is_bool($value)) {
        $value = $value ? Craft::t('app', 'Yes') : Craft::t('app', 'No');
    }
    if ($value instanceof DateTime) {
        $value = Craft::$app->getFormatter()->asDatetime($value, 'medium');
    }
    if ($value instanceof MultiOptionsFieldData) {
        $value = $this->normalizeValue(ArrayHelper::getColumn($value, 'label'));
    }
    if ($value instanceof SingleOptionFieldData) {
        $value = $value->label;
    }
    if ($value instanceof Address) {
        $value = $this->normalizeAddress($value);
    }
    if ($value instanceof ElementQuery) {
        $value = $this->normalizeValue($value->all());
    }
    if ($value instanceof SuperTableBlockElement) {
        $value = $this->normalizeSuperTableBlock($value);
    }
    if ($value instanceof User) {
        $value = "{$value->fullName} ({$value->id})";
    }
    if ($value instanceof Element) {
        $value = $value->hasTitles()
            ? "{$value->title} ({$value->id})"
            : $value->id;
    }
    return (string) $value;
}