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
            'joined_barbecues_view',
            [(new User())->barbecuesFriendships(), (new User())->barbecuesFriendships2()],
            true
        );

    }

    public function down(): void
    {
        Schema::dropIfExists('joined_barbecues_view');
    }
};
