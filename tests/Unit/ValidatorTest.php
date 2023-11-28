<?php

it('validates a string', function () {
    expect(\Core\Validator::string('foobar'))->toBeTrue();
    expect(\Core\Validator::string(false))->toBeFalse();
    expect(\Core\Validator::string(''))->toBeFalse();
});

it('validates a string with minimum lenght', function () {
    expect(\Core\Validator::string('foobar', 20))->toBeFalse();
});

it('validates an email', function () {
    expect(\Core\Validator::email('foobar'))->toBeFalse();
    expect(\Core\Validator::email('foobar@example.com'))->toBe('foobar@example.com');
});