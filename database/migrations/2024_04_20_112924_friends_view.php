<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Staudenmeir\LaravelMergedRelations\Facades\Schema;

use App\Models\User;

return new class extends Migration
{
    public function up()
    {
        Schema::createOrReplaceMergeView(
            'friends_view',
            [(new User())->acceptedSentFriendRequests(), (new User())->acceptedRecievedFriendRequests()],
            true
        );

    }

    public function down(): void
    {
        Schema::dropIfExists('friends_view');
    }
};
