<?php

use App\Models\User;

describe('Barbecues', function() {
    test('User can create a barbecue', function() {
        $user = User::factory()->create();
        $barbecue = $user->barbecues()->create([
            'title' => 'Test barbecue',
            'content' => 'This is a test barbecue',
            'address' => 'Random street 123',
            'latitude' => '123',
            'longitude' => '123',
        ]);

        expect($user->barbecues()->count())->toBe(1);
    });

    test('User can invite a user to a barbecue', function() {
        $user_1 = User::factory()->create();
        $user_2 = User::factory()->create();

        $barbecue = $user_1->barbecues()->create([
            'title' => 'Test barbecue',
            'content' => 'This is a test barbecue',
            'address' => 'Random street 123',
            'latitude' => '123',
            'longitude' => '123',
        ]);

        $barbecue->sendInvitation($user_2);

        expect($barbecue->invitations()->count())->toBe(1);
    });

    test('A new barbecue has the owner as a member by default', function() {
        $user = User::factory()->create();
        $barbecue = $user->barbecues()->create([
            'title' => 'Test barbecue',
            'content' => 'This is a test barbecue',
            'address' => 'Random street 123',
            'latitude' => '123',
            'longitude' => '123',
        ]);

        expect($barbecue->members()->count())->toBe(1);

        $member = $barbecue->members()->first();

        expect($member->id)->toBe($user->id);
    });

    test('User can accept an invitation to a barbecue', function() {
        $user_1 = User::factory()->create();
        $user_2 = User::factory()->create();

        $barbecue = $user_1->barbecues()->create([
            'title' => 'Test barbecue',
            'content' => 'This is a test barbecue',
            'address' => 'Random street 123',
            'latitude' => '123',
            'longitude' => '123',
        ]);

        $barbecue->sendInvitation($user_2);
        $user_2->acceptBarbecueInvitation($barbecue);

        expect($barbecue->members()->count())->toBe(2);
    });

    test('User can request to join a barbecue', function() {
        $user_1 = User::factory()->create();
        $user_2 = User::factory()->create();

        $barbecue = $user_1->barbecues()->create([
            'title' => 'Test barbecue',
            'content' => 'This is a test barbecue',
            'address' => 'Random street 123',
            'latitude' => '123',
            'longitude' => '123',
        ]);

        $user_2->sendBarbecueJoinRequest($barbecue);

        expect($barbecue->requests()->count())->toBe(1);
    });

    test('Can accept barbecue join request', function() {
        $user_1 = User::factory()->create();
        $user_2 = User::factory()->create();

        $barbecue = $user_1->barbecues()->create([
            'title' => 'Test barbecue',
            'content' => 'This is a test barbecue',
            'address' => 'Random street 123',
            'latitude' => '123',
            'longitude' => '123',
        ]);

        $user_2->sendBarbecueJoinRequest($barbecue);
        $barbecue->acceptJoinRequest($user_2);

        expect($barbecue->members()->count())->toBe(2);
    });
});