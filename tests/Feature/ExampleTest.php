<?php

it('redirects guests to the dashboard route', function () {
    $response = $this->get('/');

    $response->assertRedirect(route('dashboard'));
});
